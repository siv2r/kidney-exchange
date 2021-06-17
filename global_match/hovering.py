import json
import networkx as nx
from networkx.drawing.nx_agraph import graphviz_layout
import matplotlib
import matplotlib.pyplot as plt
import networkx as nx


def read_details(pd_details):
    """[summary]

    Args:
        pd_details ([type]): [description]

    Returns:
        [type]: [description]
    """
    with open(pd_details) as f:
        data = json.load(f)
    return data


def update_annot(ind, nodelist, pos, data, annot, G):
    """[summary]

    Args:
        ind ([type]): [description]
        nodelist ([type]): [description]
        pos ([type]): [description]
        data ([type]): [description]
        annot ([type]): [description]
        G ([type]): [description]
    """
    node_idx = ind["ind"][0]
    node = list(nodelist)[node_idx]
    xy = pos[node]
    annot.xy = xy
    node_attr = {"ID": node}
    node_attr.update(G.nodes[node])
    all_details = data[node]
    patient_string = "Patient: {} , {}, {}".format(
        "Ramesh", all_details["pBgrp"], all_details["pAge"]
    )
    donor_string = "Donor: {} , {}, {}".format(
        "arun", all_details["dBgrp"], all_details["dAge"]
    )
    text = "\n".join([patient_string, donor_string])
    annot.set_text(text)
    return


def hover(
    event, annot, nodes1, nodes2, nodes3, nodes4, top_nodes, rest, pos, data, fig, ax, G
):
    """[summary]

    Args:
        event ([type]): [description]
        annot ([type]): [description]
        nodes1 ([type]): [description]
        nodes2 ([type]): [description]
        nodes3 ([type]): [description]
        nodes4 ([type]): [description]
        top_nodes ([type]): [description]
        rest ([type]): [description]
        pos ([type]): [description]
        data ([type]): [description]
        fig ([type]): [description]
        ax ([type]): [description]
        G ([type]): [description]
    """
    vis = annot.get_visible()
    if event.inaxes == ax:
        if nodes1 is not None:
            cont1, ind1 = nodes1.contains(event)
            cont2, ind2 = nodes2.contains(event)
        else:
            cont1, cont2 = False, False
        if nodes3 is not None:
            cont3, ind3 = nodes3.contains(event)
            cont4, ind4 = nodes4.contains(event)
        else:
            cont3, cont4 = False, False

        if cont1:
            update_annot(ind1, top_nodes, pos, data, annot, G)
            annot.set_visible(True)
            fig.canvas.draw_idle()
        elif cont2:
            update_annot(ind2, top_nodes, pos, data, annot, G)
            annot.set_visible(True)
            fig.canvas.draw_idle()
        elif cont3:
            update_annot(ind3, rest, pos, data, annot, G)
            annot.set_visible(True)
            fig.canvas.draw_idle()
        elif cont4:
            update_annot(ind4, rest, pos, data, annot, G)
            annot.set_visible(True)
            fig.canvas.draw_idle()

        else:
            if vis:
                annot.set_visible(False)
                fig.canvas.draw_idle()


def hover_graph(G, cycles, solution_values, weight, pd_details):
    """
    G : networkx graph object with all nodes, but only solution edges
    cycles : list -> all possible cycles in G
    solution : list -> 1 if corresponding cycle is chosen for final solution else 0
    weight : dict -> keys: edges, values: edgeweights
    pd_details : string -> path to JSON file (dump) with patient donor details
    """

    fig, ax = plt.subplots()
    pos = graphviz_layout(G)
    data = read_details(pd_details)
    rest = []
    two_cycle_nodes_top = {}
    two_cycle_nodes_bottom = {}
    top_edges = []
    bottom_edges = []
    colour1 = "orange"
    colour2 = "purple"
    for i, cycle in enumerate(cycles):

        if len(cycle) == 3 and solution_values[i] == 1:
            ### selects chosen 2 cycles and colours the top and bottom halves of the two nodes in an opposite
            ### manner to signify corresponding PD pairs
            two_cycle_nodes_top[cycle[0]] = colour1
            two_cycle_nodes_bottom[cycle[0]] = colour2
            two_cycle_nodes_top[cycle[1]] = colour2
            two_cycle_nodes_bottom[cycle[1]] = colour1
            top_edges.append((cycle[0], cycle[1]))
            bottom_edges.append((cycle[1], cycle[0]))

    pos = graphviz_layout(G)
    # drawing two cycle nodes
    top_nodes, top_colours = two_cycle_nodes_top.keys(), two_cycle_nodes_top.values()
    bottom_nodes, bottom_colours = (
        two_cycle_nodes_bottom.keys(),
        two_cycle_nodes_bottom.values(),
    )
    # nodes other than those part of two cycles, including ones that are not part of any solution cycle
    rest = [n for n in G.nodes() if n not in top_nodes]
    """ nodes1 : top half of two cycle nodes
        nodes2 : bottom half of two cycle nodes
        nodes3 : top half of remaining nodes
        nodes4 : bottom half of remaining nodes
    """
    nodes1 = nx.draw_networkx_nodes(
        G,
        pos,
        nodelist=top_nodes,
        node_color=top_colours,
        node_size=600,
        node_shape=matplotlib.markers.MarkerStyle(marker="o", fillstyle="top"),
        label="P",
    )

    nodes2 = nx.draw_networkx_nodes(
        G,
        pos,
        nodelist=bottom_nodes,
        node_color=bottom_colours,
        node_size=600,
        node_shape=matplotlib.markers.MarkerStyle(marker="o", fillstyle="bottom"),
        label="D",
    )

    # drawing remaining nodes
    nodes3 = nx.draw_networkx_nodes(
        G,
        pos,
        nodelist=rest,
        label="P",
        node_color=colour1,
        node_size=600,
        node_shape=matplotlib.markers.MarkerStyle(marker="o", fillstyle="top"),
    )
    nodes4 = nx.draw_networkx_nodes(
        G,
        pos,
        nodelist=rest,
        node_color=colour2,
        node_size=600,
        node_shape=matplotlib.markers.MarkerStyle(marker="o", fillstyle="bottom"),
    )
    """ 
    Networkx by default draws straight arcs and places edge labels on the middle of those arcs.
    However, we draw curved arcs but edge labels still remain at their default position (midpoint of NodeA and NodeB) {inside the cycle}
    Thus we need to offset this by supplying new positions. To maintain consistency across all scales of X and Y axis, 
    and positions of nodes we take the offset as 0.3 times difference between x-coordinates of the two nodes between which 
    the edge is drawn. Different offsets are required for top edge and bottom edge of two cycles. For three cycles, the default 
    placement causes no issue.
    """
    pos_higher, pos_lower = {}, {}
    # calculating offset
    if not top_edges:
        y_off = 20

    else:
        a, b = top_edges[0]
        y_off = 0.3 * abs(pos[a][0] - pos[b][0])
    for k, v in pos.items():
        pos_higher[k] = (v[0], v[1] + y_off)
    for k, v in pos.items():
        pos_lower[k] = (v[0], v[1] - y_off)
    """
    w_top : edge weights of top edges of two cycles
    w_bottom : edge weights of bottom edges of two cycles
    w_rest : edge weights of remaining edges which can be placed in their default location
    """
    w_top = {e: str(weight[e]) for e in weight if (e in top_edges and e in G.edges())}
    w_bottom = {
        e: str(weight[e]) for e in weight if (e in bottom_edges and e in G.edges())
    }
    w_rest = {
        e: str(weight[e])
        for e in weight
        if (e in G.edges() and e not in top_edges and e not in bottom_edges)
    }
    ### Drawing edge labels
    nx.draw_networkx_edges(
        G, pos, edgelist=G.edges(), connectionstyle="arc3,rad=0.2", arrowsize=20
    )
    nx.draw_networkx_edge_labels(
        G, pos_higher, edge_labels=w_top, label_pos=0.5, verticalalignment="top"
    )
    nx.draw_networkx_edge_labels(
        G, pos_lower, edge_labels=w_bottom, label_pos=0.5, verticalalignment="bottom"
    )
    nx.draw_networkx_edge_labels(G, pos, edge_labels=w_rest, label_pos=0.5)

    # =================== HOVERING =========================
    ### setting annotation style
    annot = ax.annotate(
        "",
        xy=(0, 0),
        xytext=(20, 20),
        textcoords="offset points",
        bbox=dict(boxstyle="round", fc="w"),
        arrowprops=dict(arrowstyle="->"),
    )
    annot.set_visible(False)
    idx_to_node_dict = {idx: node for idx, node in enumerate(G.nodes)}
    fig.canvas.mpl_connect(
        "motion_notify_event",
        lambda event: hover(
            event,
            annot,
            nodes1,
            nodes2,
            nodes3,
            nodes4,
            top_nodes,
            rest,
            pos,
            data,
            fig,
            ax,
            G,
        ),
    )

    plt.show()
    plt.savefig("./result/output.svg", format="svg")

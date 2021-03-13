import hvplot.networkx as hvnx
import networkx as nx
import holoviews as hv
import matplotlib.pyplot as plt
from networkx.drawing.nx_agraph import graphviz_layout
import matplotlib.pyplot as plt
import networkx as nx
import matplotlib


def hover_graph(G, cycles, solution_values, weight):
    attrs = {}
    for node in G.nodes:
        attrs[node] = {'Blood Group': 'A+', 'Pincode': 600001, 'Age': 33}
    nx.set_node_attributes(G, attrs)

    fig, ax = plt.subplots()
    pos = graphviz_layout(G)
    # nodes1 = nx.draw_networkx_nodes(G, pos=pos, ax=ax, node_shape=matplotlib.markers.MarkerStyle(marker='o',
    #                                                                    fillstyle='top'))
    # nodes2 = nx.draw_networkx_nodes(G, pos=pos, ax=ax, node_color = 'green', node_shape=matplotlib.markers.MarkerStyle(marker='o',
    #                                                                    fillstyle='bottom'))
    # nx.draw_networkx_edges(G, pos=pos, ax=ax)

    rest = []
    two_cycle_nodes_top = {}
    two_cycle_nodes_bottom = {}
    top_edges = []
    bottom_edges = []
    colour1 = 'orange'
    colour2 = 'purple'
    # print('SOLUTIONS --------- ',solution_values )
    for i, cycle in enumerate(cycles):

        if len(cycle) == 3 and solution_values[i] == 1:
            two_cycle_nodes_top[cycle[0]] = colour1
            two_cycle_nodes_bottom[cycle[0]] = colour2
            two_cycle_nodes_top[cycle[1]] = colour2
            two_cycle_nodes_bottom[cycle[1]] = colour1
            top_edges.append((cycle[0], cycle[1]))
            bottom_edges.append((cycle[1], cycle[0]))

    pos = graphviz_layout(G)
    # drawing two cycle nodes
    top_nodes, top_colours = two_cycle_nodes_top.keys(), two_cycle_nodes_top.values()
    bottom_nodes, bottom_colours = two_cycle_nodes_bottom.keys(
    ), two_cycle_nodes_bottom.values()
    rest = [n for n in G.nodes() if n not in top_nodes]
    nodes1 = nx.draw_networkx_nodes(
        G,
        pos,
        nodelist=top_nodes,
        node_color=top_colours,
        node_size=600,
        node_shape=matplotlib.markers.MarkerStyle(
            marker='o',
            fillstyle='top'),
        label='P')
    nodes2 = nx.draw_networkx_nodes(
        G,
        pos,
        nodelist=bottom_nodes,
        node_color=bottom_colours,
        node_size=600,
        node_shape=matplotlib.markers.MarkerStyle(
            marker='o',
            fillstyle='bottom'),
        label='D')

    # drawing remaining nodes
    nodes3 = nx.draw_networkx_nodes(
        G,
        pos,
        nodelist=rest,
        label='P',
        node_color=colour1,
        node_size=600,
        node_shape=matplotlib.markers.MarkerStyle(
            marker='o',
            fillstyle='top'))
    nodes4 = nx.draw_networkx_nodes(
        G,
        pos,
        nodelist=rest,
        node_color=colour2,
        node_size=600,
        node_shape=matplotlib.markers.MarkerStyle(
            marker='o',
            fillstyle='bottom'))

    pos_higher, pos_lower = {}, {}
    # calculating offset
    if len(top_edges) != 0:
        a, b = top_edges[0]
        y_off = 0.3 * abs(pos[a][0] - pos[b][0])
        # print('y_off', y_off)
    else:
        y_off = 20

    for k, v in pos.items():
        pos_higher[k] = (v[0], v[1] + y_off)
    for k, v in pos.items():
        pos_lower[k] = (v[0], v[1] - y_off)

    w_top = {
        e: str(
            weight[e]) for e in weight if (
            e in top_edges and e in G.edges())}
    w_bottom = {
        e: str(
            weight[e]) for e in weight if (
            e in bottom_edges and e in G.edges())}
    w_rest = {
        e: str(
            weight[e]) for e in weight if (
            e in G.edges() and e not in top_edges and e not in bottom_edges)}
    # print("WTOP   ", w_top)
    # nx.draw_networkx_labels(G, pos, font_size=8, font_weight='bold')
    # #horizontalalignment = 'left',verticalalignment = 'top')
    nx.draw_networkx_edges(
        G,
        pos,
        edgelist=G.edges(),
        connectionstyle='arc3,rad=0.2',
        arrowsize=20)
    nx.draw_networkx_edge_labels(
        G,
        pos_higher,
        edge_labels=w_top,
        label_pos=0.5,
        verticalalignment='top')
    nx.draw_networkx_edge_labels(
        G,
        pos_lower,
        edge_labels=w_bottom,
        label_pos=0.5,
        verticalalignment='bottom')
    nx.draw_networkx_edge_labels(G, pos, edge_labels=w_rest, label_pos=0.5)
    # labels = {e: str(e) for e in G.edges}

    # ============ HOVERING =========================
    annot = ax.annotate(
        "", xy=(
            0, 0), xytext=(
            20, 20), textcoords="offset points", bbox=dict(
                boxstyle="round", fc="w"), arrowprops=dict(
                    arrowstyle="->"))
    annot.set_visible(False)
    idx_to_node_dict = {}
    for idx, node in enumerate(G.nodes):
        idx_to_node_dict[idx] = node

    def update_annot(ind, nodelist):
        node_idx = ind["ind"][0]
        # print(nodelist)
        node = list(nodelist)[node_idx]
        # print("nodeIdx received", node_idx)
        # print("node being accessed is ", node)
        xy = pos[node]
        annot.xy = xy
        node_attr = {'ID': node}
        node_attr.update(G.nodes[node])
        text = '\n'.join(f'{k}: {v}' for k, v in node_attr.items())
        # print('TEXT is ',text)
        annot.set_text(text)

    def hover(event):
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
            # nodes1, nodes2 = 2 cycle nodes top and bottom, nodes3, nodes4 remaining nodes top and bottom
            # print('cont is ', cont)
            # print('ind is ',ind)
            # print("Nodes1 is ", nodes1)
            if cont1:
                # print('cont1 is ', cont1)
                # print('ind1 is ',ind1)
                update_annot(ind1, top_nodes)
                annot.set_visible(True)
                fig.canvas.draw_idle()
            elif cont2:
                # print('cont2 is ', cont2)
                # print('ind2 is ',ind2)
                update_annot(ind2, top_nodes)
                annot.set_visible(True)
                fig.canvas.draw_idle()
            elif cont3:
                # print('cont3 is ', cont3)
                # print('ind3 is ',ind3)
                update_annot(ind3, rest)
                annot.set_visible(True)
                fig.canvas.draw_idle()
            elif cont4:
                # print('cont4 is ', cont4)
                # print('ind4 is ',ind4)
                update_annot(ind4, rest)
                annot.set_visible(True)
                fig.canvas.draw_idle()

            else:
                if vis:
                    annot.set_visible(False)
                    fig.canvas.draw_idle()

    fig.canvas.mpl_connect("motion_notify_event", hover)

    plt.show()

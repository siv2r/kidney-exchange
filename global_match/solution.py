from prettytable import PrettyTable
from precomputation import CyclePrecomputation
import networkx as nx
import matplotlib.pyplot as plt
import matplotlib
from networkx.drawing.nx_agraph import graphviz_layout
from jsonConversion import DataConvert
from hovering import hover_graph


def run_results(solution_values, cycles, altruistic, edges, cycleswt):
    """[summary]

    Args:
        solution_values ([type]): [description]
        cycles ([type]): [description]
        altruistic ([type]): [description]
        edges ([type]): [description]
        cycleswt ([type]): [description]

    Returns:
        [type]: [description]
    """
    transplants = 0
    altruistic_involved = 0
    paired_transplants = 0
    two_ways = 0
    three_ways = 0
    three_ways_embedded = 0
    effective_pairwise = 0
    weight = 0

    precomputation = CyclePrecomputation()

    for i in range(len(solution_values)):
        if solution_values[i] != 0:
            transplants += len(cycles[i])

            if cycles[i][0] == cycles[i][-1]:
                transplants -= 1
                paired_transplants = paired_transplants + len(cycles[i]) - 1

                if len(cycles[i]) == 3:
                    two_ways += 1
                    effective_pairwise += 1

                elif len(cycles[i]) == 4:
                    three_ways += 1
                    effective_pairwise = effective_pairwise + len(cycles[i]) - 1

                    three_ways_embedded += precomputation.calculate_backarc(
                        cycles[i], edges
                    )
                else:
                    effective_pairwise = effective_pairwise + len(cycles[i]) - 1

            else:
                altruistic_involved += 1

            weight += cycleswt[tuple(cycles[i])]

    return (
        transplants + len(altruistic) - altruistic_involved,
        paired_transplants,
        len(altruistic) - altruistic_involved,
        two_ways,
        three_ways,
        three_ways_embedded,
        effective_pairwise,
        weight,
    )


def cyclesAndChains(cycles, solution_values):
    """[summary]

    Args:
        cycles ([type]): [description]
        solution_values ([type]): [description]

    Returns:
        [type]: [description]
    """
    length2_cycles = []
    length3_cycles = []
    length1_chain = []
    length2_chain = []

    for i in range(len(solution_values)):
        if solution_values[i] != 0:

            if cycles[i][0] == cycles[i][-1]:
                if len(cycles[i]) == 3:
                    length2_cycles.append(cycles[i])
                if len(cycles[i]) == 4:
                    length3_cycles.append(cycles[i])
            else:
                if len(cycles[i]) == 2:
                    length1_chain.append(cycles[i])
                if len(cycles[i]) == 3:
                    length2_chain.append(cycles[i])

    return length2_cycles, length3_cycles, length1_chain, length2_chain


def poolDescription(all_cycles):
    """[summary]

    Args:
        all_cycles ([type]): [description]

    Returns:
        [type]: [description]
    """
    length2_count = 0
    length3_count = 0
    short_chain_count = 0
    long_chain_count = 0

    for cycle in all_cycles:
        if cycle[0] == cycle[-1]:
            if len(cycle) == 3:
                length2_count += 1

            if len(cycle) == 4:
                length3_count += 1

        else:
            if len(cycle) == 2:
                short_chain_count += 1

            else:
                long_chain_count += 1

    return length2_count, length3_count, short_chain_count, long_chain_count


def print_graph(
    solution_values, cycles, names, altruistic_donors, dirname, weight, pd_details
):
    """[summary]

    Args:
        solution_values ([type]): [description]
        cycles ([type]): [description]
        names ([type]): [description]
        altruistic_donors ([type]): [description]
        dirname ([type]): [description]
        weight ([type]): [description]
        pd_details ([type]): [description]
    """
    for i in range(len(solution_values)):
        if solution_values[i] != 0:
            print(cycles[i])

    G = nx.DiGraph()
    G.add_nodes_from(names)

    for i in range(len(solution_values)):
        if solution_values[i] != 0:
            for j in range(len(cycles[i]) - 1):
                edge = (cycles[i][j], cycles[i][j + 1])
                G.add_edge(*edge)

    rest = []
    two_cycle_nodes_top = {}
    two_cycle_nodes_bottom = {}
    top_edges = []
    bottom_edges = []
    colour1 = "lightgreen"
    colour2 = "lightpink"
    for i, cycle in enumerate(cycles):

        if len(cycle) == 3 and solution_values[i] == 1:
            two_cycle_nodes_top[cycle[0]] = colour1
            two_cycle_nodes_bottom[cycle[0]] = colour2
            two_cycle_nodes_top[cycle[1]] = colour2
            two_cycle_nodes_bottom[cycle[1]] = colour1
            top_edges.append((cycle[0], cycle[1]))
            bottom_edges.append((cycle[1], cycle[0]))

    pos = graphviz_layout(G)
    ### drawing two cycle nodes
    top_nodes, top_colours = two_cycle_nodes_top.keys(), two_cycle_nodes_top.values()
    bottom_nodes, bottom_colours = (
        two_cycle_nodes_bottom.keys(),
        two_cycle_nodes_bottom.values(),
    )
    rest = [n for n in G.nodes() if n not in top_nodes]
    nodes = nx.draw_networkx_nodes(
        G,
        pos,
        nodelist=top_nodes,
        node_color=top_colours,
        node_size=600,
        node_shape=matplotlib.markers.MarkerStyle(marker="o", fillstyle="top"),
        label="P",
    )
    nx.draw_networkx_nodes(
        G,
        pos,
        nodelist=bottom_nodes,
        node_color=bottom_colours,
        node_size=600,
        node_shape=matplotlib.markers.MarkerStyle(marker="o", fillstyle="bottom"),
        label="D",
    )

    ### drawing remaining nodes
    nx.draw_networkx_nodes(
        G,
        pos,
        nodelist=rest,
        node_color="lightgreen",
        node_size=600,
        node_shape=matplotlib.markers.MarkerStyle(marker="o", fillstyle="top"),
    )
    nx.draw_networkx_nodes(
        G,
        pos,
        nodelist=rest,
        node_color="lightpink",
        node_size=600,
        node_shape=matplotlib.markers.MarkerStyle(marker="o", fillstyle="bottom"),
    )
    # hover_graph(G, cycles, solution_values, weight, pd_details)
    pos_higher, pos_lower = {}, {}
    ### calculating offset
    if not top_edges:
        y_off = 20

    else:
        a, b = top_edges[0]
        y_off = 0.3 * abs(pos[a][0] - pos[b][0])

    for k, v in pos.items():
        pos_higher[k] = (v[0], v[1] + y_off)
    for k, v in pos.items():
        pos_lower[k] = (v[0], v[1] - y_off)

    w_top = {e: str(weight[e]) for e in weight if (e in top_edges and e in G.edges())}
    w_bottom = {
        e: str(weight[e]) for e in weight if (e in bottom_edges and e in G.edges())
    }
    w_rest = {
        e: str(weight[e])
        for e in weight
        if (e in G.edges() and e not in top_edges and e not in bottom_edges)
    }
    nx.draw_networkx_labels(
        G, pos, font_size=8, font_weight="bold"
    )  # horizontalalignment = 'left',verticalalignment = 'top')
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
    plt.savefig("{}/graph.png".format(dirname))  # save as png
    plt.show()  # display


def print_solution(
    run_no,
    constraint,
    max_length,
    solution_values,
    cycles,
    altruists,
    edges,
    cycleswt,
    names,
    dirname,
    weight_dict,
    pd_details,
):
    """[summary]

    Args:
        run_no ([type]): [description]
        constraint ([type]): [description]
        max_length ([type]): [description]
        solution_values ([type]): [description]
        cycles ([type]): [description]
        altruists ([type]): [description]
        edges ([type]): [description]
        cycleswt ([type]): [description]
        names ([type]): [description]
        dirname ([type]): [description]
        weight_dict ([type]): [description]
        pd_details ([type]): [description]

    Returns:
        [type]: [description]
    """

    file_name = dirname + "/" + "solution"
    with open(file_name, "w") as f:
        print("RUN DESCRIPTION")
        f.write("RUN DESCRIPTION" + "\n")
        x = PrettyTable()
        x.field_names = ["Run number", "Constraint", "Max Length"]
        x.add_row([run_no, constraint, max_length])
        print(x)
        f.write(str(x))

        print()
        f.write("\n")

        print("RUN RESULTS")
        f.write("RUN RESULTS" + "\n")
        (
            transplants_plus_unused_al,
            paired_transplants,
            unused_altruistic,
            two_ways,
            three_ways,
            three_ways_embedded,
            effective_pairwise,
            weight,
        ) = run_results(solution_values, cycles, altruists, edges, cycleswt)
        x = PrettyTable()
        x.field_names = [
            "Run number",
            "Transplants(including unused altruistic)",
            "Paired Transplants",
            "nused altruistic Donors ",
            "2-ways",
            "3-ways ",
            "3-ways with embedded",
            "Effective Pairwise",
            "Weight",
        ]
        x.add_row(
            [
                run_no,
                transplants_plus_unused_al,
                paired_transplants,
                unused_altruistic,
                two_ways,
                three_ways,
                three_ways_embedded,
                effective_pairwise,
                weight,
            ]
        )
        print(x)
        f.write(str(x))

        print()
        f.write("\n")

        print("CYCLES AND CHAINS")
        f.write("CYCLES AND CHAINS" + "\n")
        length2_cycles, length3_cycles, length1_chain, length2_chain = cyclesAndChains(
            cycles, solution_values
        )
        x = PrettyTable()
        x.field_names = ["Type", "Cycles/Chains"]
        x.add_row(["Cycles of length 2", length2_cycles])
        x.add_row(["Cycles of length 3", length3_cycles])
        x.add_row(["Chains of length 1", length1_chain])
        x.add_row(["Chains of length 2", length2_chain])
        x.align = "l"
        print(x)
        f.write(str(x))
        print()
        f.write("\n")

        print("DESCRIPTION OF POOL")
        f.write("CYCLES AND CHAINS" + "\n")
        (
            length2_count,
            length3_count,
            short_chain_count,
            long_chain_count,
        ) = poolDescription(cycles)
        x = PrettyTable()
        x.field_names = [
            "Patients",
            "Paired donors",
            "Altruistic donors",
            "Vertices",
            "2-cycles",
            "3-cycles",
            "Short chains",
            "Long chains",
        ]
        x.add_row(
            [
                len(names),
                len(names),
                len(altruists),
                len(names) + len(altruists),
                length2_count,
                length3_count,
                short_chain_count,
                long_chain_count,
            ]
        )
        print(x)
        f.write(str(x))

        print()
        f.write("\n")

        print("SOLUTION")
        print_graph(
            solution_values, cycles, names, altruists, dirname, weight_dict, pd_details
        )
    return transplants_plus_unused_al

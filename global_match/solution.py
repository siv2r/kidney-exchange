from prettytable import PrettyTable
from precomputation import CyclePrecomputation
import networkx as nx
import matplotlib.pyplot as plt


def run_results(solution_values, cycles, altruistic, edges, cycleswt):
    transplants = 0
    altruistic_involved = 0
    paired_transplants = 0
    two_ways = 0
    three_ways = 0
    three_ways_embedded = 0
    effective_pairwise = 0
    weight = 0

    precomputation = CyclePrecomputation()

    for i in range(0, len(solution_values)):
        if solution_values[i] != 0:
            transplants = transplants + len(cycles[i])

            if cycles[i][0] == cycles[i][-1]:
                transplants = transplants - 1
                paired_transplants = paired_transplants + len(cycles[i]) - 1

                if len(cycles[i]) == 3:
                    two_ways = two_ways + 1
                    effective_pairwise = effective_pairwise + 1

                elif len(cycles[i]) == 4:
                    three_ways = three_ways + 1
                    effective_pairwise = effective_pairwise + len(cycles[i]) - 1

                    three_ways_embedded = (
                        three_ways_embedded
                        + precomputation.calculate_backarc(cycles[i], edges)
                    )
                else:
                    effective_pairwise = effective_pairwise + len(cycles[i]) - 1

            else:
                altruistic_involved = altruistic_involved + 1

            weight = weight + cycleswt[tuple(cycles[i])]

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
    length2_cycles = []
    length3_cycles = []
    length1_chain = []
    length2_chain = []

    for i in range(0, len(solution_values)):
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
    length2_count = 0
    length3_count = 0
    short_chain_count = 0
    long_chain_count = 0

    for cycle in all_cycles:
        if cycle[0] == cycle[-1]:
            if len(cycle) == 3:
                length2_count = length2_count + 1

            if len(cycle) == 4:
                length3_count = length3_count + 1

        else:
            if len(cycle) == 2:
                short_chain_count = short_chain_count + 1

            else:
                long_chain_count = long_chain_count + 1

    return length2_count, length3_count, short_chain_count, long_chain_count


def print_graph(solution_values, cycles, names, altruistic_donors, dirname):
    for i in range(0, len(solution_values)):
        if solution_values[i] != 0:
            print(cycles[i])

    values = []

    G = nx.DiGraph()
    G.add_nodes_from(names)
    paired = [1] * len(names)

    G.add_nodes_from(altruistic_donors)
    altruists = [0.5] * len(altruistic_donors)

    values = paired + altruists

    for i in range(0, len(solution_values)):
        if solution_values[i] != 0:
            for j in range(0, len(cycles[i]) - 1):
                edge = (cycles[i][j], cycles[i][j + 1])
                G.add_edge(*edge)

    pos = nx.spring_layout(G)
    nx.draw_networkx_nodes(
        G, pos, cmap=plt.get_cmap("jet"), node_color=values, node_size=300
    )
    nx.draw_networkx_labels(G, pos)
    nx.draw_networkx_edges(G, pos, edgelist=G.edges())
    # plt.savefig("image.png")
    plt.savefig("{}/output.png".format(dirname))  # save as png
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
):

    file_name = dirname + "/" + "solution"
    f = open(file_name, "w")

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
    length2_count, length3_count, short_chain_count, long_chain_count = poolDescription(
        cycles
    )
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
    print_graph(solution_values, cycles, names, altruists, dirname)
    f.close()
    return transplants_plus_unused_al

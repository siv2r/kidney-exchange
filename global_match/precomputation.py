from itertools import combinations
from itertools import permutations
import numpy


class CyclePrecomputation:
    all_cycles = []
    cycles = []

    def __init__(self):
        all_cycles = []
        cycles = []

    def permutations2(self, lst):
        # print('in permutations, finding perumations of ',lst)

        if len(lst) == 0:
            # print('in zero case')
            return []

        if len(lst) == 1:
            # print('len==1')
            return [lst]

        l = []

        for i in range(len(lst)):
            m = lst[i]
            remlst = lst[:i] + lst[i + 1 :]

            for p in self.permutations2(remlst):
                l.append([m] + p)

        # print('permuations are ', l)
        return l

    def combinations2(self, lst, n):
        if n == 0:
            return [[]]

        l = []
        for i in range(0, len(lst)):
            m = lst[i]
            remLst = lst[i + 1 :]
            for p in self.combinations2(remLst, n - 1):
                l.append([m] + p)
        return l

    def find_cycles(self, Names, malength):
        for i in range(2, malength + 1):
            comb = self.combinations2(Names, i)
            temp = []
            for lis in comb:
                com = lis[1:]
                perm = self.permutations2(com)

                for per in perm:
                    fin = []
                    fin.append(lis[0])
                    fin.extend(per)
                    fin.append(lis[0])
                    # print(fin)
                    self.all_cycles.append(fin)

    def find_chains(self, Names, malength, altruists):
        for node in altruists:
            for i in range(1, malength + 1):
                comb = combinations2(Names, i)
                temp = []
                for lis in comb:
                    perm = permutations2(lis)

                    for per in perm:
                        fin = []
                        fin.append(node)
                        fin.extend(per)
                        self.all_cycles.append(fin)

    def check_cycle(self, cycle, edges):
        # print(edges)
        for i in range(0, len(cycle) - 1):
            edge = [cycle[i], cycle[i + 1]]

            if edge not in edges:
                # print("printing edge ", edge)
                return False

        return True

    def find_cycles_in_graph(self, edges):
        # print(edges)
        for cycle in self.all_cycles:
            # print("in find cycles ", cycle)
            if self.check_cycle(cycle, edges):
                self.cycles.append(tuple(cycle))
                # print(tuple(cycle))
        return self.cycles

    def findwt(self, cycles, weight):
        cycleswt = {}
        for cycle in cycles:
            wt = 0
            for i in range(0, len(cycle) - 1):
                edge = (cycle[i], cycle[i + 1])
                wt = wt + weight[edge]
            cycleswt[cycle] = wt

        return cycleswt

    def findCyclesAndChains(
        self, names, max_cycle_length, max_chain_length, altruists, edges
    ):
        self.find_cycles(names, max_cycle_length)
        self.find_chains(names, max_chain_length, altruists)
        cycles = self.find_cycles_in_graph(edges)
        # print(cycles)
        return cycles

    def check_backarc(self, cycle, edges):
        for i in range(0, len(cycle) - 1):
            edge = [cycle[i + 1], cycle[i]]
            if edge in edges:
                return True

        return False

    def calculate_backarc(self, cycle, edges):
        ans = 0
        if len(cycle) == 3:
            return 1
        for i in range(0, len(cycle) - 1):
            edge = [cycle[i + 1], cycle[i]]
            if edge in edges:
                ans = ans + 1

        return ans

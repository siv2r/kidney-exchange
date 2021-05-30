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
        '''This will show in permutations, finding perumations of ',lst value'''

        if len(lst) == 0:
            '''This will update that it is in the zero state'''
            return []

        if len(lst) == 1:
            '''Shows the value of len that is 1'''
            return [lst]

        l = []

        for i in range(len(lst)):
            m = lst[i]
            remlst = lst[:i] + lst[i + 1 :]

            for p in self.permutations2(remlst):
                l.append([m] + p)

        '''Prints that the permuations are ', l value'''
        return l

    def combinations2(self, lst, n):
        if n == 0:
            return [[]]

        l = []
        for i in range(len(lst)):
            m = lst[i]
            remLst = lst[i + 1 :]
            for p in self.combinations2(remLst, n - 1):
                l.append([m] + p)
        return l

    def find_cycles(self, Names, malength):
        temp = []
        for i in range(2, malength + 1):
            comb = self.combinations2(Names, i)
            for lis in comb:
                com = lis[1:]
                perm = self.permutations2(com)

                for per in perm:
                    fin = [lis[0], *per, lis[0]]
                    # print(fin)
                    self.all_cycles.append(fin)

    def find_chains(self, Names, malength, altruists):
        temp = []
        for node in altruists:
            for i in range(1, malength + 1):
                comb = combinations2(Names, i)
                for lis in comb:
                    perm = permutations2(lis)

                    for per in perm:
                        fin = [node, *per]
                        self.all_cycles.append(fin)

    def check_cycle(self, cycle, edges):
        '''Display the "edges" value'''
        for i in range(len(cycle) - 1):
            edge = [cycle[i], cycle[i + 1]]

            if edge not in edges:
                '''Shows the message printing edge , edge value'''
                return False

        return True

    def find_cycles_in_graph(self, edges):
        '''Display the "edges" value'''
        for cycle in self.all_cycles:
            '''Shows the message in find cycles , cycle value'''
            if self.check_cycle(cycle, edges):
                self.cycles.append(tuple(cycle))
                '''Display tuple(cycle) value'''
        return self.cycles

    def findwt(self, cycles, weight):
        cycleswt = {}
        for cycle in cycles:
            wt = 0
            for i in range(len(cycle) - 1):
                edge = (cycle[i], cycle[i + 1])
                wt += weight[edge]
            cycleswt[cycle] = wt

        return cycleswt

    def findCyclesAndChains(
        self, names, max_cycle_length, max_chain_length, altruists, edges
    ):
        self.find_cycles(names, max_cycle_length)
        self.find_chains(names, max_chain_length, altruists)
        return self.find_cycles_in_graph(edges)

    def check_backarc(self, cycle, edges):
        for i in range(len(cycle) - 1):
            edge = [cycle[i + 1], cycle[i]]
            if edge in edges:
                return True

        return False

    def calculate_backarc(self, cycle, edges):
        ans = 0
        if len(cycle) == 3:
            return 1
        for i in range(len(cycle) - 1):
            edge = [cycle[i + 1], cycle[i]]
            if edge in edges:
                ans += 1

        return ans

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
        """[summary]

        Args:
            lst ([type]): [description]

        Returns:
            [type]: [description]
        """

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
        """[summary]

        Args:
            lst ([type]): [description]
            n ([type]): [description]

        Returns:
            [type]: [description]
        """

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
        """[summary]

        Args:
            Names ([type]): [description]
            malength ([type]): [description]
        """

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
        """[summary]

        Args:
            Names ([type]): [description]
            malength ([type]): [description]
            altruists ([type]): [description]
        """

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
        """[summary]

        Args:
            cycle ([type]): [description]
            edges ([type]): [description]

        Returns:
            [type]: [description]
        """

        # print(edges)
        for i in range(len(cycle) - 1):
            edge = [cycle[i], cycle[i + 1]]

            if edge not in edges:
                # print("printing edge ", edge)
                return False

        return True

    def find_cycles_in_graph(self, edges):
        """[summary]

        Args:
            edges ([type]): [description]

        Returns:
            [type]: [description]
        """

        # print(edges)
        for cycle in self.all_cycles:
            # print("in find cycles ", cycle)
            if self.check_cycle(cycle, edges):
                self.cycles.append(tuple(cycle))
                # print(tuple(cycle))
        return self.cycles

    def findwt(self, cycles, weight):
        """[summary]

        Args:
            cycles ([type]): [description]
            weight ([type]): [description]

        Returns:
            [type]: [description]
        """

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
        """[summary]

        Args:
            names ([type]): [description]
            max_cycle_length ([type]): [description]
            max_chain_length ([type]): [description]
            altruists ([type]): [description]
            edges ([type]): [description]

        Returns:
            [type]: [description]
        """

        self.find_cycles(names, max_cycle_length)
        self.find_chains(names, max_chain_length, altruists)
        return self.find_cycles_in_graph(edges)

    def check_backarc(self, cycle, edges):
        """[summary]

        Args:
            cycle ([type]): [description]
            edges ([type]): [description]

        Returns:
            [type]: [description]
        """

        for i in range(len(cycle) - 1):
            edge = [cycle[i + 1], cycle[i]]
            if edge in edges:
                return True

        return False

    def calculate_backarc(self, cycle, edges):
        """[summary]

        Args:
            cycle ([type]): [description]
            edges ([type]): [description]

        Returns:
            [type]: [description]
        """

        ans = 0
        if len(cycle) == 3:
            return 1
        for i in range(len(cycle) - 1):
            edge = [cycle[i + 1], cycle[i]]
            if edge in edges:
                ans += 1

        return ans

	#!/usr/bin/python
# ---------------------------------------------------------------------------
# File: vertex_cover.py
# Version 12.9.0
# ---------------------------------------------------------------------------
# Licensed Materials - Property of IBM
# 5725-A06 5725-A29 5724-Y48 5724-Y49 5724-Y54 5724-Y55 5655-Y21
# Copyright IBM Corporation 2009, 2019. All Rights Reserved.
#
# US Government Users Restricted Rights - Use, duplication or
# disclosure restricted by GSA ADP Schedule Contract with
# IBM Corp.
# ---------------------------------------------------------------------------
"""Input is a graph.

"""  
from __future__ import print_function

import sys
sys.path.insert(1, '/home/shan/kidney_exchange')
import cplex
from cplex.exceptions import CplexSolverError
from precomputation import CyclePrecomputation
import datetime

def optimize_length(cycles,vertices,dirname, coef=[], ilp=True):
	prob = cplex.Cplex()
	prob.set_problem_name("KIDNEY EXCHANGE")
	names = []

	#Set problem type as LP or ILP
	prob.set_problem_type(cplex.Cplex.problem_type.LP)
	obj = coef

	
	c={}
	i = 0
	for cycle in cycles:
		names.append("c_%s" % str(cycle))
		i = i+1

	#Adds variable and related data to problem
    #obj is a list of floats, specifying linear objective coefficient of variables.
    #lb:- lower bound, ub:- upper bound
    #types must be either list of single-character string or a string containing types of variables
    #names is a list of string
    #column may be a list of sparse vector or matrix in a list of list format
	# option = int((input("Choose option\n1.ILP\n2.LP")))

	if ilp:
		prob.variables.add(obj=obj,names=names, lb=[0] * len(names),
                    ub=[1] * len(names),
                    types=["B"] * len(names))

	elif not ilp:
		prob.variables.add(obj=obj,names=names, lb=[0] * len(names),
                    ub=[1] * len(names),
                    types=["C"] * len(names))


	constraints = []
	constraint_names = []
	for v in vertices:
		constraint = []
		constraint_names = []
		i = 0
		for cycle in cycles:
			if v in cycle:
				constraint.append(names[i])
			i = i+1
		if constraint:
			constraint_names.append("v" + str(v))
			# Adds a linear constraint to the problem.
			# lin_expr may either be a list of sparse pair instances, or matrix in a list of a list format.
			# senses must be either a list of single-character string or a string containing the senses of linear constraint. Each entry must be one of ‘G’, ‘L’, ‘E’, ‘R’ ->greater than, less than, equality and ranged constraint.
			# rhs is a list of floats specifying right hand side of each linear constraint.
			# returns an iterator containing indices of added linear constraint
			prob.linear_constraints.add(lin_expr=[cplex.SparsePair(constraint, [1] * len(constraint))],senses=['L'],rhs=[1],names=constraint_names)

	prob.objective.set_sense(prob.objective.sense.maximize)
	#dump the lp in file
	prob.write(dirname +"/" + "optimize_length.lp")

	start  = prob.get_time()

	#Solving with local cplex
	prob.solve()

	end = prob.get_time()

	print ("SUM IS",sum(prob.solution.get_values()))

	print("*****************************************************************")
	print(end-start)
	print("*****************************************************************")

	#return values of all variables from problem.
	return prob.solution.get_values()



def optimize_weight(cycles,vertices,weight,dirname,ilp):
	#option is ilp option
	prob = cplex.Cplex()
	prob.set_problem_name("KIDNEY EXCHANGE")

	names = []

	prob.set_problem_type(cplex.Cplex.problem_type.LP)\

	obj =[]
	for cycle in cycles:
		obj.append(weight[tuple(cycle)])

	c={}
	i = 0
	for cycle in cycles:
		names.append("c_%s" % str(cycle))
		i = i+1

	# option = int((input("Choose option\n1.ILP\n2.LP")))

	if ilp:
		prob.variables.add(obj=obj,names=names, lb=[0] * len(names),
                    ub=[1] * len(names),
                    types=["B"] * len(names))

	elif not ilp:
		prob.variables.add(obj=obj,names=names, lb=[0] * len(names),
                    ub=[1] * len(names),
                    types=["C"] * len(names))


	constraints = []
	constraint_names =[]
	for v in vertices:
		constraint = []
		i = 0
		for cycle in cycles:
			if v in cycle:
				constraint.append(names[i])
			i = i+1
		if constraint:
			names.append("v" + v)
			prob.linear_constraints.add(lin_expr=[cplex.SparsePair(constraint, [1] * len(constraint))],senses=['L'],rhs=[1],names=constraint_names)

	prob.objective.set_sense(prob.objective.sense.maximize)
	prob.write(dirname +"/" + "optimize_weight.lp")

	start  = prob.get_time()
	
	prob.solve()

	end = prob.get_time()
	print("*****************************************************************")
	print(end-start)
	print("*****************************************************************")

	return prob.solution.get_values()

def removechains(cycles):
	onlyCycles = []
	for cycle in cycles:
		if cycle[0] == cycle[-1]:
			onlyCycles.append(cycle)
	return onlyCycles

def maximize_pairwise_exchange(cycles,vertices,dirname,edges,ilp):
	coef = []
	precomputation = CyclePrecomputation()

	for cycle in cycles:

		x = precomputation.calculate_backarc(cycle,edges) #+ len(cycle)
		x = x + len(cycle)
		print(cycle,"       ",x,"    ",len(cycle),"     ",x-len(cycle))
		coef.append(x)


	solution_values = optimize_length(cycles,vertices,dirname,coef,ilp)


	print (solution_values)
	return solution_values

def maximize_total_transplants(cycles,vertices,dirname,ilp):
	solution_values = optimize_length(cycles,vertices,dirname, coef=[], ilp=ilp)
	print(solution_values)
	return solution_values

def maximize_total_weight(cycles,vertices,cycle_wt,dirname, ilp):
	solution_values = optimize_weight(cycles,vertices,cycle_wt,dirname, ilp)
	print(solution_values)
	return solution_values

# def kidney_exchange(names,edges,ma,weight,altruists,ilp):
# 	all_cycles = find_cycles(names,len(names),ma,altruists)
# 	cycles = find_cycles_in_graph(all_cycles,edges)
# 	print(cycles)
# 	cycleswt = findwt(cycles,weight)
# 	# print(cycleswt)
# 	print(a)
# 	if int(a) == 1:
# 		solution_values = optimize_length(cycles,names,ma,altruists)
# 		solution(1,"size",ma,solution_values,cycles,altruists,edges,cycleswt,names)
# 	elif int(a) == 2:
# 		optimize_weight(cycles,names,cycleswt,ma,option)



if __name__ == "__main__":
	names = ['0','1','2','3']
	edges = [['0','1'],['1','0'],['0','3'],['3','2'],['2','0']]
	all_cycles = find_cycles(names,3,3)
	print(all_cycles)
	cycles = find_cycles_in_graph(all_cycles,edges)
	print("******************************************************************************************************")
	print(cycles)
	#optimize(cycles,names)
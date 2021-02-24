
import sys 
import shutil
# from kidney_exchange import kidney_exchange
import sys
sys.path.insert(1, '/home/shan/kidney_exchange')

from jsonConversion import DataConvert
from precomputation import CyclePrecomputation
from kidney_exchange import maximize_pairwise_exchange
from kidney_exchange import maximize_total_transplants
from kidney_exchange import maximize_total_weight
from solution import print_solution
import argparse
import datetime
import time
import os
import sys 
import csv

names =[]
edges =[]
weight = {}
altruistic_donors = []

fnames = ['Total Patients',  'Altruistic Donors', 'Maximum cycle size',  'Maximum chain size', 'Transplants',  'Constraint']

def fillexcel(patients,altruistic_donors,max_cycle_length,max_chain_length,transplants,Constraint):
  with open('kidney.csv', 'a', newline='') as file:
    writer = csv.writer(file)
    writer.writerow([patients,altruistic_donors,max_cycle_length,max_chain_length,transplants,Constraint])

def pipeline(file_name, option,max_cycle_length,max_chain_length,ilp):
  x = datetime.datetime.now()
  path = os.getcwd()+'/'
  dirName = 'result'
  if not os.path.exists(dirName):
      os.mkdir(dirName)
  else:    
      print("Directory " , dirName ,  " already exists")
      

  destination = dirName
  shutil.copy(file_name, destination)
  graph = dirName + '/' + "graph"
  f = open(graph, "w")
  json_convert = DataConvert(json_file)
  precomputation = CyclePrecomputation()

  names,edges,weight,altruistic_donors = json_convert.convert_altruistic()
  f.write(str(len(names)) + " "+ str(len(altruistic_donors)) + " " + str(len(edges)))
  for name in names:
    f.write(str(name)+ "\n")
  for altruistic_donor in altruistic_donors:
    f.write(str(altruistic_donor)+ "\n")
  for edge in edges :
    f.write("[" + edge[0] + " " + edge [1] + "] "  + str(weight[tuple(edge)]) + "\n")

  f.close()
  
  # option = int(input("Choose option \n1.Maximize the number of effective pairwise exchange \n2.Maximize the total number of transplants\n3.Maximize the total number of backarcs\n4.Maximize the total weight\n5.Minimize the number of 3-way exchange\n6.Maximize the number of pairwise exchange "))

  #Basically maximizing the total number of cycles which does not involve altruistic donor
  start = time.time()
  if option == 1:
    cyclesAndChains = precomputation.findCyclesAndChains(names,max_cycle_length,max_chain_length ,altruistic_donors,edges)
    end = time.time()
    print(cyclesAndChains)
    cycleandchain_wt = precomputation.findwt(cyclesAndChains,weight) 
    solution_values = maximize_pairwise_exchange(cyclesAndChains,names,dirName,edges,ilp)
    transplants = print_solution(1, "Maximize the number of effective pairwise exchange", max_cycle_length, solution_values, cyclesAndChains, altruistic_donors, edges, cycleandchain_wt, names,dirName)
    fillexcel(len(names),len(altruistic_donors),max_cycle_length,max_chain_length,transplants,"Maximize the number of effective pairwise exchange")

  #Maximize the number of patients that get a kidney. This will involve altruistic donors as well
  elif option == 2:
    cyclesAndChains = precomputation.findCyclesAndChains(names,max_cycle_length,max_chain_length ,altruistic_donors,edges)
    end = time.time()
    cycleandchain_wt = precomputation.findwt(cyclesAndChains,weight) 
    solution_values = maximize_total_transplants(cyclesAndChains,names+altruistic_donors,dirName,ilp)
    transplants = print_solution(1, "Maximize the total number of transplants", max_cycle_length, solution_values, cyclesAndChains, altruistic_donors, edges, cycleandchain_wt, names,dirName)
    fillexcel(len(names),len(altruistic_donors),max_cycle_length,max_chain_length,transplants,"Maximize the total number of transplants")

  #No of backarcs in 3-way exchange should be maximized(a 3-way exchange can contain more than one backarc.)
  elif option == 3:
    print("Yet to be done")
    sys.exit()

  #Maximize the total weight calculated by summing over all cycles and chains
  elif option == 4:
    cyclesAndChains = precomputation.findCyclesAndChains(names,max_cycle_length,max_chain_length ,altruistic_donors,edges)
    end = time.time()
    cycleandchain_wt = precomputation.findwt(cyclesAndChains,weight) 
    solution_values = maximize_total_weight(cyclesAndChains,names + altruistic_donors,cycleandchain_wt,dirName,ilp)
    transplants = print_solution(1, "Maximize the total weight", max_cycle_length, solution_values, cyclesAndChains, altruistic_donors, edges, cycleandchain_wt, names,dirName)
    fillexcel(len(names),len(altruistic_donors),max_cycle_length,max_chain_length,transplants,"Maximize the total weight")

  elif option == 5:
    print("Yet to be done")
    sys.exit()

  #Maximize the number of pairwise exchange plus unused altruists:-
  elif option == 6:
    cyclesAndChains = precomputation.findCyclesAndChains(names,2,1 ,altruistic_donors,edges)
    end = time.time()
    cycleandchain_wt = precomputation.findwt(cyclesAndChains,weight) 
    solution_values = maximize_total_transplants(cyclesAndChains, names + altruistic_donors,dirName,ilp)
    transplants = print_solution(1, "Maximize pairwise exchange", 2, solution_values, cyclesAndChains, altruistic_donors, edges, cycleandchain_wt, names,dirName)
    fillexcel(len(names),len(altruistic_donors),max_cycle_length,max_chain_length,transplants,"Maximize the number of pairwise exchange")

  print("Runtime of the program is ",end - start)


if __name__ == "__main__":
  option_string = "Choose option \n1.Maximize the number of effective pairwise exchange \n2.Maximize the total number of transplants\n3.Maximize the total number of backarcs\n4.Maximize the total weight\n5.Minimize the number of 3-way exchange\n6.Maximize the number of pairwise exchange "
  parser = argparse.ArgumentParser()
  my_parser = argparse.ArgumentParser()
  my_parser.add_argument('-f','--file',help='path to compatibility graph json file', required=True, default='genjson-0.json')
  my_parser.add_argument('-s','--max_size', action='store', type=int, help = 'maximum cycle size', default=3 )
  my_parser.add_argument('-a','--altruistic', action='store', type=int, help='number of altruistic donors',default = 0)
  my_parser.add_argument('-o','--option',action='store',type=int,help=option_string,default=1)
  my_parser.add_argument('-i','--ilp',action='store',type=bool,help='using ILP vs LP',default=True)
  args = my_parser.parse_args()
  json_file = args.file
  max_size = args.max_size
  altruistic_donors = args.altruistic
  option = args.option
  ilp = args.ilp
  pipeline(json_file,option,max_size,altruistic_donors,ilp)
  
 

  



  





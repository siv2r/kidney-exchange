import json

''' page to read json file (pair id and '''


class DataConvert:

    def __init__(self, file_name):
        self.file = file_name

    def convert_altruistic(self):
        # file_name is dummy argument to be removed
        file_name = self.file
        names = []
        edges = []
        weight = {}
        altruistic = []

        with open(file_name) as json_file:
            data = json.load(json_file)

            for key, value in data['data'].items():
                if "altruistic" in value:
                    altruistic.append((key))
                    if "matches" in value:
                        for matches in value["matches"]:
                            edge = [str(key), str(matches["recipient"])]
                            edges.append(edge)
                            weight[tuple(edge)] = matches["score"]
                else:
                    a1 = value["sources"]
                    for p in a1:
                        names.append(str(p))
                        if "matches" in value:
                            for matches in value["matches"]:
                                edge = [str(p), str(matches["recipient"])]
                                edges.append(edge)
                                weight[tuple(edge)] = matches["score"]

            for p in altruistic:
                for q in names:
                    edge = [str(q), str(p)]
                    edges.append(edge)
                    weight[tuple(edge)] = 0

        return names, edges, weight, altruistic

    # def convert(self,file_name=None):
    #   # file_name is dummy argument to be removed
    #   with open(self.file) as json_file:
    #     data = json.load(json_file)

    #     for p in data['data'].values():
    #       a1 = p['sources'][0]
    #       names.append(str(a1))
    #       #print(a1)
    #       if "matches" in p:
    #         for matches in p["matches"]:
    #           edge=[str(a1),str(matches["recipient"])]
    #           edges.append(edge)
    #           print (a1,"                          ",matches["recipient"])
    #           weight[tuple(edge)] = matches["score"]

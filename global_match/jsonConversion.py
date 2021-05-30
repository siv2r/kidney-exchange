import json

""" script to read compatibility graph json file and get pair-id, edges 
(which pair can donate to which pair) and altruistic donors
 """


class DataConvert:
    def __init__(self, file_name):
        """[summary]

        Args:
            file_name ([type]): [description]
        """
        self.file = file_name

    def convert_altruistic(self):
        """[summary]

        Returns:
            [type]: [description]
        """
        file_name = self.file
        names = []
        edges = []
        weight = {}
        altruistic = []

        with open(file_name) as json_file:
            data = json.load(json_file)

            for key, value in data["data"].items():
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

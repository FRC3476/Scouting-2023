import trueskill
import json
import sys
from collections import defaultdict
import traceback

def main():
  team_lookup = defaultdict(lambda : trueskill.Rating())
  ranking_data = json.loads(sys.argv[1])

  for rank_list in ranking_data:
    trueskill_input_teams = []
    trueskill_ranks = []
    for i in range(len(rank_list)):
      if rank_list[i] == 0:
        break
      trueskill_input_teams.append((team_lookup[rank_list[i]],))
      trueskill_ranks.append(i)
    if len(trueskill_input_teams) > 1:
      output_trueskill = trueskill.rate(trueskill_input_teams, trueskill_ranks)
      
      for i in range(len(rank_list)):
        if rank_list[i] == 0:
          break
        team_lookup[rank_list[i]] = output_trueskill[i][0]

  out = []
  for team in team_lookup.keys():
    out.append([team, team_lookup[team].mu, team_lookup[team].sigma])

  print(json.dumps(out))


if __name__ == '__main__':
  main()

#arr = [['x','x','x'],['o','o','x'],['x','o','o']]
#rr = [['x','o','x'],['o','o','o'],['x','o','o']]
#arr = [['x','o','x'],['o','x','o'],['x','o','x']]
#arr = [['a','o','x'],['b','x','o'],['c','o','x']]
arr = [['a','b','g'],['d','g','f'],['g','h','i']]


def print_grid(grid):
    for row in grid:
        print row

def sol(grid):
    tmp = None

    for i in range(3): # tests down across top row
        for k in range(3):
            if tmp is None:
                tmp = grid[i][k]
            elif tmp is grid[i][k]:
                if range(3)[-1] is k: # then we're done and there is indeed a win
                    return True
            else: # tells us that current element doesnt match last element
                tmp = None
                break

    tmp = None

    for j in range(3): # tests down across top row
        for l in range(3):
            if tmp is None:
                tmp = grid[l][j]
            elif tmp is grid[l][j]:
                if range(3)[-1] is k: # then we're done and there is indeed a win
                    return True
            else: # tells us that current element doesnt match last element
                tmp = None
                break
    
    tmp = grid[0][0]

    for m in range(3):
        if tmp is grid[m][m]:
            if m is range(3)[-1]:
                return True
        else:
            break

    tmp = grid[-1][0] 

    for n1,n2 in zip(range(2,-1,-1),range(3)):
        if tmp is grid[n1][n2]:
            if n1 is range(2,-1,-1)[-1]:
                return True
        else:
            break


print_grid(arr)
print sol(arr)

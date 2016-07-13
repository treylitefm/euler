from math import sqrt

def is_prime(num):
    return len(factor(num)) == 1

def factor(num):
    '''Note: this does not do prime factorization'''
    root = sqrt(num)
    factors = [num]

    for i in range(2,int(root)+1):
        if num%i is 0:
            factors.append(i)
            factors.append(num/i)
    return factors

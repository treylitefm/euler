def divide(dividend, divisor):
    diff = 0
    q = ''
    dividend = str(dividend)
    digits = len(dividend)

    for i in dividend+'0'*100000:
        i = int(i)
        if diff is 0 and i is 0:
            break
        res = (diff+i)/divisor
        q += str(res)
        diff = (diff+i) - (res*divisor)
        diff *= 10

    return q[0:digits]+'.'+q[digits:]


def find_repeat_decimal(decimal):
    '''Pass in everything after decimal point'''
    if decimal is None or decimal is '':
        return ''

    for i in range(1,len(decimal)):
        for j in range(1,i+1):
            #print decimal[i-j:i],decimal[i:i+j],decimal[i-j:i] == decimal[i:i+j]
            if decimal[i-j:i] == decimal[i:i+j]:
                #import ipdb; ipdb.set_trace()
                if decimal[i-j:i]*10 == decimal[i:i+j*10]: #if its a single repeat, then the next n digits should all be identical
                    return decimal[i-j:i]
        #print '-'*10

def main():
    quotients = []
    cycles = []

    for i in range(1,1000):
        quotients.append(divide(1, i))

    for q in quotients:
        cycles.append(find_repeat_decimal(q[2:]))

    cycles = map(lambda x: str(x) if x is not None else '', cycles)
    cycles_len = map(len, cycles)

    output = zip(range(1,1000),cycles,cycles_len)

    for i in output:
        print i

    #print quotients
    #print cycles
    #print cycles_len
    print max(cycles_len)

import time
start_time = time.time()
main()
print("--- %s seconds ---" % (time.time() - start_time))

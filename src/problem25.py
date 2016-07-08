def count_digits(n):
    return len(str(n))

n1 = 1
n2 = 1
total = 0
i = 2

while count_digits(total) != 1000:
    total = n1 + n2
    n2 = n1
    n1 = total
    i += 1

print "First 1000th digit number in the fibonacci sequence occurs at index:",i

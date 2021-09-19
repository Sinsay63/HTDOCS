T=[4,14,45,34,67,34,7,4,0]
M=T[0]
a=0
for i in range(0,len(T)):
    if T[i]>M :
        M=T[i]                            
print(M)

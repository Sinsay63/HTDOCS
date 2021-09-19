T=[]
n=int(input("Saisir un nombre:"))
for i in range(1,n+1):
    if n%i==0:
        T.append(i)

print(T)



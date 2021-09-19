from random import*
def listealeatoire(n):
    L=[]
    for i in range(n):
        L.append(randint(1,10))
    return(L)

#print(listealeatoire(20))



'''def singletons(L):
    c=0
    T=[]
    for i in range(len(L)):
        for j in range(0,i):
            if L[i]==L[j]:
                c=c+1
        if c==0:
            T.append(L[i])
        c=0
    return(T)'''

def singletons(L):
    T=[]
    c=0
    for i in range(len(L)):
        M=L[i]
        for j in range(len(L)):
            if M==L[j]:
                T.append(M)
    return(T)
                
                
                


    
#print(singletons([1,3,6,2,3,1,3,4,6]))

def nboccurences(n,L):
    compteur=0
    for i in range(len(L)):
        if n==L[i]:
            compteur=compteur+1
    return(compteur)

#print("Votre nombre est présent",nboccurences(1,[1,3,3,3,9]),"fois.")

LA=listealeatoire(20)
T=singletons(LA)
G=[]
nb=0
for i in range(len(LA)):
    for j in range(len(T)):
        if T[i] == LA[j]:
            nb=nb+1
        G.append(T[i])
print(G)
            
            

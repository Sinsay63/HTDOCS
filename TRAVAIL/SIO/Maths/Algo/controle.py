n=int(input("Saisir votre nombre de valeurs: "))

def saisie(n):
    L=[]
    for i in range(n):
        nb=int(input("Saisir une valeur: "))
        L.append(nb)
    return(L)

#print(saisie(n))


def mystere(L):
    M=L[0]
    for i in range(len(L)):
        if L[i]<M:
            M=L[i]
    return(M)

#print(mystere([1,3,5,7]))


def moyenne(L):
    somme=0
    for i in range(len(L)):
        somme=somme+L[i]
    moyenne=somme/len(L)
    return(moyenne)
#print(moyenne([1,3,5,7]))

def negative(L):
    compteur=0
    for i in range(len(L)):
        if L[i]<0:
            compteur=compteur+1
    return(compteur)
#print(negative([-1,2,-3]))

nbsaisie=saisie(n)
moyennes=moyenne(nbsaisie)
negatif=negative(nbsaisie)

print(nbsaisie)
print(moyennes)
print(negatif)




    
    
    
   

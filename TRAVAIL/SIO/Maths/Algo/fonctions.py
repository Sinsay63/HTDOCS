
def diviseur(nb):
    L=[]
    for i in range(1,nb+1):
        if nb%i ==0:
            L.append(i)
    return(L)
#print(diviseur(3))


def commun(L1,L2): 
    commun=[]
    for i in range(len(L1)):
        for j in range(len(L2)):
            if L1[i]==L2[j]:
                commun.append(L1[i])
    return(commun)
#print(commun([1,3,5,15],[1,2,3,4,5]))


def mxi(L):
    maxi=L[0]
    for i in range (len(L)):
        if L[i] > maxi:
            maxi=L[i]
    return(maxi)
#print(mxi([1,3,5]))
    




nb1=int(input("Saisir un nombre entier: "))
nb2=int(input("Saisir un nombre entier: "))
div1=diviseur(nb1)
div2=diviseur(nb2)
elmtcommun=commun(div1,div2)
pgcd=mxi(elmtcommun)

    
    
print("Le PGCD de", nb1,"et", nb2," est",pgcd)

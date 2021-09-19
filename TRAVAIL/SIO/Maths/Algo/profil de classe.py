#Fonctions#

#Fonction somme
L=[4,8,12,16,20]
def somme(L):
   Som=0
   for i in range(len(L)):
       Som=Som+L[i]
   return(Som)

print(somme(L))

def mini(L):
    Inf=L[0]
    for i in range (len(L)):
        if L[i] < Inf:
            Inf=L[i]
    return(Inf)
print(mini(L))

def max(L):
    maxi=L[0]
    for i in range (len(L)):
        if L[i] > maxi:
            maxi=L[i]
    return(maxi)
print(max(L))

def inf10(L):
    nb=0
    for i in range(len(L)):
        if L[i]<10:
            nb=nb+1
    return(nb)
print(inf10(L))
        
        
    

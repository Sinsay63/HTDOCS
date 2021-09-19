T=[4,14,45,34,67,34,7,4,0]
nb=int(input("Saisir un nombre: "))
oui=0
for i in range(len(T)):
    if nb==T[i]:
        oui=oui+1    
    
if oui>=1:
    print(nb,"est une valeur dans la liste.")

elif oui==0:
    print(nb," n'est pas une valeur dans la liste.")    

    

    

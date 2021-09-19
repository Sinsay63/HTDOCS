essais=0
from random import*
nb_secret=randint(1,10000)
nb_deviné=int(input("Entrez un nombre: "))
essais=essais+1

while (nb_deviné!= nb_secret):
       if (essais !=15):
            print("nombre d'essais:",essais)
            if (nb_deviné > nb_secret):
                print("Le nombre secret est plus petit.")
                nb_deviné=int(input("Entrez un nombre: "))
                essais=essais+1        

            elif (nb_deviné< nb_secret): 
                print("Le nombre secret est plus grand.")
                nb_deviné=int(input("Entrez un nombre: "))
                essais=essais+1    

       else:
            print("Vous avez atteint le nombre maximal d'essais (15).")
            print ("Le nombre secret était",nb_secret,".")
            break
else:
       print("Bien joué, tu as trouvé le nombre secret",nb_secret,"au bout de",essais,"essai(s).")


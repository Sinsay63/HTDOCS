case=0
nb_riz=0.5
nb_total=0
while case!=64:
    case=case+1
    nb_riz=nb_riz*2
    nb_total=nb_riz+nb_riz
    print("Sur la case",round(case,),",il y a",round(nb_riz,),"grains de riz")

print("Le nombre total de grains de riz est de",round(nb_total,))

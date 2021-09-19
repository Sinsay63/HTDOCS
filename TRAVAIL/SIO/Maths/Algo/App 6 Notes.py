nb_notes=int(input("Saisir le nombre de notes: "))
notes=[]
somme=0

for i in range(0,nb_notes):
    note=int(input("Saisir une note: "))
    notes.append(note)
    somme=somme+note

moyenne=somme/nb_notes
print("La moyenne est de",round(moyenne,2))

H=notes[0]
B=notes[0]

for i in range(0,nb_notes):
    if notes[i]<B:
        B=notes[i]
        
    elif notes[i]>H:
        H=notes[i]

            
print("La moyenne la plus haute est",H)
print("La moyenne la plus basse est",B)

etudiant=str(input("Êtes-vous étudiant? O/N : "))
age=int(input("Entrez votre âge: "))

if etudiant=="O" and age<25:
    print("Tu paies moins chèr.")

elif etudiant=="N":
        print("Va faire des études!")

elif etudiant=="O" and age>25:
            print("Tu paies plus chèr.")


def nboccurences(n,L):
    compteur=0
    for i in range(len(L)):
        if n==L[i]:
            compteur=compteur+1
    return(compteur)

print("Votre nombre est présent",nboccurences(1,[1,3,3,3,9]),"fois.")

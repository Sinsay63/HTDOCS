p50 = 0 
p20 = 0 
p10 = 0 
p5 = 0 
p2 = 0 
p1 = 0 

centimes=int(input("Saisir un montant en centimes: "));

p50=centimes //50;
centimes= centimes%50;
p20=centimes //20;
centimes= centimes%20;
p10=centimes //10;
centimes= centimes%10;
p5=centimes //5;
centimes= centimes%5;
p2=centimes //2;
centimes= centimes%2;
p1=centimes 
print ("Il y a:",p50,"pièce(s) de 50 centimes")
print ("Il y a:",p20,"pièce(s) de 20 centimes")
print ("Il y a:",p10,"pièce(s) de 10 centimes")
print ("Il y a:",p5,"pièce(s) de 5 centimes")
print ("Il y a:",p2,"pièce(s) de 2 centimes")
print ("Il y a:",p1,"pièce(s) de 1 centime")

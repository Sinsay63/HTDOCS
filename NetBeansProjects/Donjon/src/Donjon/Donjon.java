package Donjon;
import java.util.Random;
import java.util.Scanner;
public class Donjon {
    public static void main(String[] args) {
        int phase=0;
        int vie=10;
        int gold=0;
        System.out.println("Bienvenue jeune aventurier, te voilà désormais à l'entrée de la Forteresse");
        while(vie>0){
            System.out.println("Souhaitez-vous entrer et acquérir de nouvelles richesses ou alors retournez dans les jupons de votre mère? (Oui ou Non)");
            if(phase==0){
                Scanner entree = new Scanner(System.in);
                String entrée = entree.nextLine();
                if (entrée.equals("Oui")){
                    phase++;
                } 
                else if(entrée.equals("Non")){
                    System.out.println("Vous ne souhaitez pas entrer dans la Forteresse."); 
                    System.out.println(gold+" pièce(s) d'or collectée(s). Votre score est de "+gold+".");
                    break;
                }
                else{
                    System.out.println("Répondez correctement jeune aventurier!");
                }
            }
            if (phase==1) {
                System.out.println("Vous voilà maintenant à l'intérieur de la Forteresse!");
                System.out.println("Vous avancez et décidez de faire un pile ou face pour savoir si vous allez affronter un des gardiens de ce Donjon. ");
                Scanner delay = new Scanner(System.in);
                String delai = delay.nextLine();
                Random pileface = new Random();
                int pileF = pileface.nextInt((1- 0) + 1) + 0;
                if(pileF==0){
                    System.out.println("Vous avez fait: Pile.");
                    System.out.println("Une aura menaçante autour de vous se fait ressentir. Vous décidez d'avancer.");
                    Scanner delay1 = new Scanner(System.in);
                    String delai1 = delay1.nextLine();
                    phase++;
                }
                else{
                    System.out.println("Vous avez fait: Face.");
                    int faces20 = 1 + (int)(Math.random() * ((20 - 1) + 1));
                    System.out.println("Vous lancez un dé de 20 faces, et vous faites "+faces20+". Vous récupérez donc "+faces20+ " pièce(s) d'or.");
                    gold+=faces20;
                    System.out.println("Votre montant de pièces d'or s'éléve à "+gold+".");
                    System.out.println("Vous retournez à l'entrée du Donjon avec les poches remplies d'or.");
                    Scanner delay2 = new Scanner(System.in);
                    String delai2 = delay2.nextLine();
                    phase--;
                }
            }
            if (phase==2){
                System.out.println("Un gardien apparait devant vous, que souhaitez-vous faire? Entrez un nombre entre 1 et 3.");
                System.out.println("Réponse: 1  Charger l'ennemi.");
                System.out.println("Réponse: 2  Attendre l'attaque de l'ennemi et la parer.");
                System.out.println("Réponse: 3  Prendre ses jambes à son cou pour prendre la fuite.");
                int saisie=0;
                while(saisie ==0){
                    Scanner repphase2 = new Scanner(System.in);
                    int rephase2 = repphase2.nextInt();
                    if(rephase2==1){
                        int choix1 = 1 + (int)(Math.random() * ((3 - 1) + 1));
                        if (choix1==1){
                            System.out.println("Vous chargez votre adversaire et parvenez à le Oneshot ! Monstre abattu ! Vous gagnez 60 pièces d'or.");
                            gold+=60;
                            System.out.println("Votre montant de pièces d'or s'éléve à "+gold+".");
                            Scanner delay3 = new Scanner(System.in);
                            String delai3 = delay3.nextLine();
                        }
                        else if (choix1 ==2 || choix1==3){
                            System.out.println("Vous chargez et parvenez à asséner un grand coup d'épée au Gardien. ");
                            System.out.println("Dans son dernier souffle, le Gardien parvient à vous infliger un coup de griffes et vous retire 3 points de vie.");
                            vie-=3;
                            if (vie<=0){   
                                vie=0; 
                                break;
                            }
                            else if (vie>0){
                                System.out.println("Le monstre est tout de même abattu, vous gagnez 60 pièces d'or.");
                                gold+=60;
                                System.out.println("Vos points de vie sont désormais de "+vie+" et votre montant de pièces d'or s'éléve à "+gold+".");
                                Scanner delay4 = new Scanner(System.in);
                                String delai4 = delay4.nextLine();
                            }
                        }
                        saisie++;
                        phase++;
                    }
                    if(rephase2==2){
                        int choix2 = 1 + (int)(Math.random() * ((3 - 1) + 1));
                        if (choix2 ==1 || choix2==2){
                                System.out.println("Vous réussissez à parer son attaque, bien que ses griffes vous frôlent, vous sortez votre botte secrète et le terassez.");
                                System.out.println("Gardien abattu ! Vous gagnez 25 pièces d'or.");
                                gold+=25;
                                System.out.println("Votre montant de pièces d'or s'éléve à "+gold+".");
                                Scanner delay5 = new Scanner(System.in);
                                String delai5 = delay5.nextLine();
                        }
                        else if (choix2 ==3){
                            System.out.println("Après une parade quelque peu maladroite, vous trébuchez sur un rocher et plantez votre épée dans son coeur. Le Gardien réussit dans son dernier souffle à vous toucher. ");
                            vie-=2; 
                            if (vie<=0){ 
                                System.out.println("Bien que vous êtes parvenu à vaincre le Gardien, vous perdez 2 points de vie.");
                                vie=0; 
                                break;
                            }
                            else if (vie>0){
                                gold+=20;
                                System.out.println("Gardien abattu ! Vous avez perdu 2 points de vie et gagnez 20 pièces d'or.");
                                System.out.println("Vos points de vie sont désormais de "+vie+" et votre montant de pièces d'or s'éléve à "+gold+".");
                                Scanner delay6 = new Scanner(System.in);
                                String delai6 = delay6.nextLine();
                            }
                        }
                        saisie++;
                        phase++;
                    }
                    if(rephase2==3){
                        int choix3 = 1 + (int)(Math.random() * ((3 - 1) + 1));
                        if (choix3 ==1 || choix3==2){
                            System.out.println("Vous réussissez à prendre la fuite, et grâce à votre grande dextérité, vous parvenez à voler 15 pièces d’or à l’ennemi avant de vous échapper.");
                            gold+=15;
                            System.out.println("Votre montant de pièces d'or s'éléve à "+gold+".");
                            System.out.println("Vous voilà désormais à l'entrée du Donjon.");
                            phase=0;
                            break;
                        }
                        else if (choix3 ==3){
                            System.out.println("Durant votre fuite, vous vous précipitez et vous vous tordez la cheville mais réussissez quand même à fuir. ");
                            System.out.println("Cette blessure vous inflige 1 point de vie.");
                            vie-=1;
                            System.out.println("Vos points de vie sont désormais de "+vie+" et votre montant de pièces d'or s'éléve à "+gold+".");
                        }
                        saisie++;
                        phase++;
                    }
                    else if (rephase2 >3 || rephase2<1){
                        System.out.println("Valeur erronée. Entrez un nombre entre 1 et 3.");
                        saisie=0;
                    }
                }
            }   
            if (phase==3){
                System.out.println("Vous continuez à avancer dans les profondeurs du Donjon, un sentiment de peur se fait de plus en plus grand en vous. ");
                int choix4 = 1 + (int)(Math.random() * ((6 - 1) + 1));
                if (choix4 >1){
                    System.out.println("Après quelques minutes de marches sans rencontrer de problèmes, vous trouvez enfin la sortie.");
                }
                else {
                    System.out.println("Votre peur s'intensifie. Des frissons vous parcourent le corps, quand tout à coup, un monstre sorti de l'ombre vous inflige un coup de poignard dans le dos avant de retourner dans les ombres du Donjon.");
                    System.out.println("Cette attaque sournoise vous inflige 3 points de dégats.");
                    vie-=3;
                    if (vie<=0){
                        vie=0;
                        break;
                    }
                    else if (vie>0){
                        System.out.println("Vous parvenez à trouver la sortie du Donjon après quelques minutes de marche.");
                    }
                }
                phase=0;
            }
        }
        if (vie==0){
        System.out.println("GAME OVER ! Vous êtes mort et perdez tout votre or. ");
        }
    }
}

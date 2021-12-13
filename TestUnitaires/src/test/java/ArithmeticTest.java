
import com.sio.Arithmetic;
import static org.junit.jupiter.api.Assertions.*;
import org.junit.jupiter.api.Test;

public class ArithmeticTest {

    @Test
    public void isPrimitif() {
        Arithmetic truc = new Arithmetic();
        assertTrue(truc.isPrimeNumber(0));
    }

    @Test
    public void getFibonnacci() {
        Arithmetic truc = new Arithmetic();
        assertEquals(17, truc.getFibonacci(10), "Fibonnacci");
    }

    @Test
    public void getPiWithDecimals() {
        Arithmetic truc = new Arithmetic();
        assertEquals(3.1, truc.getPiWithDecimals(1), "piDecimals1");
        assertEquals(3.14, truc.getPiWithDecimals(2), "piDecimals2");
        assertEquals(3.141, truc.getPiWithDecimals(3), "piDecimals3");
        assertEquals(3.1415, truc.getPiWithDecimals(4), "piDecimals4");
    }

    @Test
    public void getProductOfArray() {
        Arithmetic truc = new Arithmetic();
        double[] tab = new double[]{1, 2, 5};
        assertEquals(10, truc.getProductOfArray(tab), "product Array");
    }
    
    @Test
    public void getPGCD(){
        Arithmetic truc = new Arithmetic();
        assertEquals(1,truc.getPGCD(1, 2),"tset pgcd");
    }
}

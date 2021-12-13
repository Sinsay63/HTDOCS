
import com.sio.Geometry;
import com.sio.Point;
import static org.junit.jupiter.api.Assertions.*;
import org.junit.jupiter.api.Test;

public class GeometryTest {

    @Test
    public void getAreaTriangle() {
        Geometry geo = new Geometry();
        assertEquals(50, geo.getAreaTriangle(10, 5));
    }

    @Test
    public void getCylinderVolume() {
        Geometry geo = new Geometry();
        assertEquals(310.86, geo.getCylinderVolume(3, 11));
    }

    @Test
    public void getDistanceBetweenPoints​() {
        Geometry geo = new Geometry();
        Point pt1 = new Point(1, 1);
        Point pt2 = new Point(5, 1);
        assertEquals(5, geo.getDistanceBetweenPoints(pt1, pt2));
    }
    
    @Test
    public void getGravityCenter(){
        Geometry geo = new Geometry();
        Point smt1 = new Point(0, 0);
        Point smt2 = new Point(2, 0);
        Point smt3 = new Point(1, 2);
        assertSame(new Point(1,1),geo.getGravityCenterTriangle(smt1, smt2, smt3));
    }
}

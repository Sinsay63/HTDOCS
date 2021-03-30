package heritage;
import java.text.SimpleDateFormat;
import java.util.Date;
public class Time {
    
    
    public  String getTime(){
        SimpleDateFormat simpleDateFormat = new SimpleDateFormat("HH:mm:ss");
        Date temps = new Date();
        return simpleDateFormat.format(temps);
    }
}

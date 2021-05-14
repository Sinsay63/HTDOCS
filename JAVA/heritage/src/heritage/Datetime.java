package heritage;
import java.text.SimpleDateFormat;
import java.util.Date;
public class Datetime extends Time{
    
    @Override
    public  String getTime(){
        
        SimpleDateFormat simpleDateFormat = new SimpleDateFormat("dd/MM/yyyy hh:mm:ss");
        Date temps = new Date();
        return simpleDateFormat.format(temps);
    }
}

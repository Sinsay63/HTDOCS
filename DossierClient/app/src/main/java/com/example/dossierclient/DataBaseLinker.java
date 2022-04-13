package com.example.dossierclient;
import android.content.Context;
import android.database.sqlite.SQLiteDatabase;
import android.util.Log;

import com.example.dossierclient.dao.Client;
import com.example.dossierclient.dao.Ville;
import com.j256.ormlite.android.apptools.OrmLiteSqliteOpenHelper;
import com.j256.ormlite.dao.Dao;
import com.j256.ormlite.support.ConnectionSource;
import com.j256.ormlite.table.TableUtils;

public class DataBaseLinker extends OrmLiteSqliteOpenHelper {

    private static final String DATABASE_NAME = "dossierclient.db";
    private static final int DATABASE_VERSION = 1;

    public DataBaseLinker( Context context ) {
        super( context, DATABASE_NAME, null, DATABASE_VERSION );
    }

    @Override
    public void onCreate(SQLiteDatabase database, ConnectionSource connectionSource) {
        try {
            TableUtils.createTable( connectionSource, Client.class );
            TableUtils.createTable( connectionSource, Ville.class );
            Ville ville1 = new Ville("Clermont-Ferrand");
            Ville ville2 = new Ville("Issoire");
            Client client1 = new Client("maltrait","alain","0750253428","8 rue de la palombière",ville2);
            Client client2 = new Client("houdier","laurent","0679544849","5 allée des jardins d'Aubière",ville1);
            Client client3 = new Client("beauger","andre","0682598803","7 avenue de la république",ville2);

            Dao<Client, Integer> daoClient = this.getDao( Client.class );
            Dao<Ville, Integer> daoVille = this.getDao( Ville.class );
            daoClient.create(client1);
            daoClient.create(client2);
            daoClient.create(client3);
            daoVille.create(ville1);
            daoVille.create(ville2);
            Log.i( "DATABASE", "onCreate invoked" );
        } catch( Exception exception ) {
            Log.e( "DATABASE", "Can't create Database", exception );
        }
    }

    @Override
    public void onUpgrade(SQLiteDatabase database, ConnectionSource connectionSource, int oldVersion, int newVersion) {
        try {
            Log.i( "DATABASE", "onUpgrade invoked" );
        } catch( Exception exception ) {
            Log.e( "DATABASE", "Can't upgrade Database", exception );
        }
    }

}

package com.example.dossierclient;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.database.SQLException;

import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;

import android.widget.TableLayout;
import android.widget.TableRow;
import android.widget.TextView;

import com.example.dossierclient.dao.Client;

import com.j256.ormlite.dao.Dao;

import java.util.ArrayList;
import java.util.List;


public class MainActivity extends AppCompatActivity {

    private TableLayout TableCLient;
    private TextView textTitre;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        this.deleteDatabase("dossierclient.db");

        displayClients();
    }

    public List<Client> getAllCLient(){
        List<Client> listeCLient = new ArrayList<>();
        DataBaseLinker linker = new DataBaseLinker(this);
        try {
            Dao<Client, Integer> daoClient = linker.getDao( Client.class );
            listeCLient = daoClient.queryForAll();

        } catch (SQLException | java.sql.SQLException throwables) {
            throwables.printStackTrace();
        }
        linker.close();
        return listeCLient;
    }

    public void displayClients() {
        List<Client> listeClient = getAllCLient();
        TableCLient = findViewById(R.id.TableClient);
        textTitre = findViewById(R.id.textTitre);

        Button btnCreate = new Button(this);
        btnCreate.setText("Ajouter un client");
        btnCreate.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent monIntent = new Intent(MainActivity.this, SecondActivity.class);
                monIntent.putExtra("create", 1);
                startActivity(monIntent);

            }
        });
        TableRow rowCreate = new TableRow(this);
        rowCreate.addView(btnCreate);
        TableCLient.addView(rowCreate);

        for(int cpt =0 ; cpt<listeClient.size();cpt++){
            Client client = (Client) listeClient.get(cpt);
            TableRow newRow = new TableRow(this);

            Button btnDelete = new Button(this);
            btnDelete.setText("Delete");
            btnDelete.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {
                    deleteClient(client.getIdClient());
                    TableCLient.removeView(newRow);
                }
            });

            Button btnInfo = new Button(this);
            btnInfo.setText("Infos");

            btnInfo.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {
                    Intent monIntent = new Intent(MainActivity.this, SecondActivity.class);
                    monIntent.putExtra("idClient", client.getIdClient());
                    startActivity(monIntent);

                }
            });

            TextView textNomClient = new TextView(this);
            TextView textPrenomClient = new TextView(this);
            textNomClient.setText("Nom : "+client.getNom());
            textPrenomClient.setText("Prénom : "+client.getPrenom());
            newRow.addView(textNomClient);
            newRow.addView(textPrenomClient);
            newRow.addView(btnDelete);
            newRow.addView(btnInfo);

            TableCLient.addView(newRow);
        }


    }

    public void deleteClient(int idClient){
        DataBaseLinker linker = new DataBaseLinker(this);
        try {
            Dao<Client, Integer> daoClient = linker.getDao( Client.class );
            Client client = daoClient.queryForId(idClient);
            if (client != null) {
                daoClient.delete(client);
            }

        } catch (SQLException | java.sql.SQLException throwables) {
            throwables.printStackTrace();
        }
        linker.close();

    }
}
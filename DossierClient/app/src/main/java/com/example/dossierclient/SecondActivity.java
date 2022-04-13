package com.example.dossierclient;

import android.content.Intent;
import android.database.SQLException;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Spinner;
import android.widget.TableLayout;
import android.widget.TableRow;
import android.widget.TextView;

import androidx.appcompat.app.AppCompatActivity;

import com.example.dossierclient.dao.Client;
import com.example.dossierclient.dao.Ville;
import com.j256.ormlite.dao.Dao;

import java.util.ArrayList;
import java.util.List;
public class SecondActivity extends AppCompatActivity
{
    private TextView textTitreInfos;
    private TableLayout TableInfosClient;
    private Client client;
    private Button btnEdit;
    private EditText editNom;
    private EditText editPrenom;
    private EditText editTel;
    private EditText editAdresse;
    private Spinner editVille;
    private Button btnReturn;
    private Button btnCreate;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.info_client);

        textTitreInfos = findViewById(R.id.textTitreInfos);
        TableInfosClient = findViewById(R.id.TableInfosClient);


        Intent intent = this.getIntent();
        int idClient = intent.getIntExtra("idClient",0);
        int createClient = intent.getIntExtra("create",0);
        if(idClient >0){
            client = getClient(idClient);
            displayInfos();
            btnEdit.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {
                    editInfos();
                    changeScene();
                }
            });
        }
        else if(createClient >0){
            createClient();
            btnCreate.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {
                    insertClient();
                    changeScene();
                }
            });
        }
        btnReturn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                changeScene();
            }
        });

    }

    public Client getClient(int idClient){

        DataBaseLinker linker = new DataBaseLinker(this);
        try {
            Dao<Client, Integer> daoClient = linker.getDao( Client.class );
            client = daoClient.queryForId(idClient);

        } catch (SQLException | java.sql.SQLException throwables) {
            throwables.printStackTrace();
        }

        linker.close();
        return client;
    }

    public void displayInfos(){
        if(client !=null){

            editNom = new EditText(this);
            editPrenom = new EditText(this);
            editTel = new EditText(this);
            editAdresse = new EditText(this);
            editVille = new Spinner(this);
            TextView textNom = new TextView(this);
            TextView textPrenom = new TextView(this);
            TextView textTel = new TextView(this);
            TextView textAdresse = new TextView(this);
            TextView textVille = new TextView(this);



            editNom.setText(client.getNom());
            editPrenom.setText(client.getPrenom());
            editTel.setText(client.getTelephone());
            editAdresse.setText(client.getAdresse());
            textNom.setText("Nom : ");
            textPrenom.setText("Prénom : ");
            textTel.setText("Téléphone : ");
            textAdresse.setText("Adresse : ");
            textVille.setText("Ville : ");


            List<Ville> listeVilles = getVilles();

            ArrayAdapter adapter = new ArrayAdapter(this,android.R.layout.simple_spinner_item,listeVilles);
            adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
            editVille.setAdapter(adapter);
            int pos = adapter.getPosition(client.getVille());
            editVille.setSelection(pos);

            TableRow rowNom = new TableRow(this);
            TableRow rowPrenom = new TableRow(this);
            TableRow rowTel = new TableRow(this);
            TableRow rowAdresse = new TableRow(this);
            TableRow rowVille = new TableRow(this);

            rowNom.addView(textNom);
            rowNom.addView(editNom);
            rowPrenom.addView(textPrenom);
            rowPrenom.addView(editPrenom);
            rowTel.addView(textTel);
            rowTel.addView(editTel);
            rowAdresse.addView(textAdresse);
            rowAdresse.addView(editAdresse);
            rowVille.addView(textVille);
            rowVille.addView(editVille);

            btnEdit = new Button(this);
            btnEdit.setText("Modifier");

            btnReturn = new Button(this);
            btnReturn.setText("Retour");

            TableInfosClient.addView(rowNom);
            TableInfosClient.addView(rowPrenom);
            TableInfosClient.addView(rowTel);
            TableInfosClient.addView(rowAdresse);
            TableInfosClient.addView(rowVille);
            TableInfosClient.addView(btnEdit);
            TableInfosClient.addView(btnReturn);
        }
    }
    public void editInfos(){
        DataBaseLinker linker = new DataBaseLinker(this);
        try {
            Dao<Client, Integer> daoClient = linker.getDao( Client.class );
            Client client2 = daoClient.queryForId(client.getIdClient());

            if (client2 != null) {
                String nom = editNom.getText().toString();
                String prenom = editPrenom.getText().toString();
                String adresse  = editAdresse.getText().toString();
                String tel = editTel.getText().toString();

                client2.setNom(nom);
                client2.setPrenom(prenom);
                client2.setTelephone(tel);
                client2.setAdresse(adresse);
                Ville ville = (Ville) editVille.getSelectedItem();
                client2.setVille(ville);

                daoClient.update(client2);
            }

        } catch (SQLException | java.sql.SQLException throwables) {
            throwables.printStackTrace();
        }
        linker.close();

    }

    public void changeScene(){
        Intent monIntent = new Intent(SecondActivity.this, MainActivity.class);
        startActivity(monIntent);
    }

    public List<Ville> getVilles(){
        DataBaseLinker linker = new DataBaseLinker(this);
        List<Ville> listeVille = null;
        try {
            Dao<Ville, Integer> daoVille = linker.getDao( Ville.class );
            listeVille = daoVille.queryForAll();
        }
        catch (SQLException | java.sql.SQLException throwables) {
            throwables.printStackTrace();
        }
        linker.close();
        return listeVille;
    }

    public void createClient(){

        editNom = new EditText(this);
        editPrenom = new EditText(this);
        editTel = new EditText(this);
        editAdresse = new EditText(this);
        editVille = new Spinner(this);

        TableRow rowNom = new TableRow(this);
        TableRow rowPrenom = new TableRow(this);
        TableRow rowTel = new TableRow(this);
        TableRow rowAdresse = new TableRow(this);
        TableRow rowVille = new TableRow(this);


        TextView textNom = new TextView(this);
        TextView textPrenom = new TextView(this);
        TextView textAdresse = new TextView(this);
        TextView textTel = new TextView(this);
        TextView textVille = new TextView(this);

        List<Ville> listeVilles = getVilles();

        ArrayAdapter adapter = new ArrayAdapter(this,android.R.layout.simple_spinner_item,listeVilles);
        adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);

        editVille.setAdapter(adapter);

        textNom.setText("Entrez le nom");
        textPrenom.setText("Entrez le prénom : ");
        textAdresse.setText("Entrez l'adresse : ");
        textTel.setText("Entrez le tel : ");
        textVille.setText("Choisissez votre ville : ");
        rowNom.addView(textNom);
        rowNom.addView(editNom);
        rowPrenom.addView(textPrenom);
        rowPrenom.addView(editPrenom);
        rowTel.addView(textTel);
        rowTel.addView(editTel);
        rowAdresse.addView(textAdresse);
        rowAdresse.addView(editAdresse);
        rowVille.addView(textVille);
        rowVille.addView(editVille);

        btnReturn = new Button(this);
        btnReturn.setText("Retour");

        btnCreate = new Button(this);
        btnCreate.setText("Créer");

        TableInfosClient.addView(rowNom);
        TableInfosClient.addView(rowPrenom);
        TableInfosClient.addView(rowTel);
        TableInfosClient.addView(rowAdresse);
        TableInfosClient.addView(rowVille);
        TableInfosClient.addView(btnCreate);
        TableInfosClient.addView(btnReturn);

    }

    public void insertClient(){
        DataBaseLinker linker = new DataBaseLinker(this);
        try {
            Dao<Client, Integer> daoClient = linker.getDao( Client.class );

                Client client = new Client();

                String nom = editNom.getText().toString();
                String prenom = editPrenom.getText().toString();
                String adresse  = editAdresse.getText().toString();
                String tel = editTel.getText().toString();

                client.setNom(nom);
                client.setPrenom(prenom);
                client.setTelephone(tel);
                client.setAdresse(adresse);
                Ville ville = (Ville) editVille.getSelectedItem();
                client.setVille(ville);

                daoClient.create(client);


        } catch (SQLException | java.sql.SQLException throwables) {
            throwables.printStackTrace();
        }
        linker.close();
    }
}


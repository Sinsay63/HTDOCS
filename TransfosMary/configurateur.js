var selector = document.getElementById('db');
var file_url = selector.getAttribute('data-csv');
//console.log(file_url);
var loader = document.getElementById('loader');
var selectsMap = new Map();
/**
*Permet d'obtenir une Map de type clé = Id du sélecteur / valeur = liste des options
**/
function buildSelectsMap(){
  var selects = document.querySelectorAll('select');
  //console.log(selects);
  selects.forEach(function (select) {
    var optionsArray = [];
    //console.log(select.id);
    var optionClass = "."+select.id;
    var options = document.querySelectorAll(optionClass);
    options.forEach(function (option) {
      //console.log(option.value);
      optionsArray.push(option.value);
    });
    selectsMap.set(select.id, options);
  });
  console.log("8888888888888888",selectsMap);
}
buildSelectsMap();

/**
*Permet de charger le fichier CSV
**/
function loadCSV(){
  activeLoader();
  jQuery.ajax({
  	url: file_url,
  	dataType: 'html',
    scriptCharset: "UTF-8",
  }).done(parseTextIntoData);
}
loadCSV();

/**
*Permet de préciser la taille d'un objet (nombre de colonnes dans le fichier CSV)
**/
function chunkArray(myArray, chunk_size){
    var index = 0;
    var arrayLength = myArray.length;
    var tempArray = [];
    
    for (index = 0; index < arrayLength; index += chunk_size) {
        myChunk = myArray.slice(index, index+chunk_size);
        tempArray.push(myChunk);
    }

    return tempArray;
}

var choices = new Map();
var selects = document.querySelectorAll('select');

/*
*Fonction MAIN. Permet d'appeler toutes les fonctions permettant la filtration
*/
function products_filtration_process(){
  //console.log(selects);
  selects.forEach(function(select){
    select.addEventListener('change', function(){
      activeLoader();
      //console.log(select.id+" - "+select.value);
      if(choices.has(select.id)){
        document.location.reload();
      }
      choices.set(select.id, select.value);
      console.log(choices);


      if(selectsMap.has(select.id)){
        selectsMap.delete(select.id);
        console.log("********",selectsMap);
      }
      
      setTimeout(function(){ 
        searchProducts();
        availableOptions();
        disableEmptySelects();
        disableLoader();
      }, 200);

    });
  });
}
products_filtration_process();


var collection = [];
/**
*Permet de transformer les données lues dans le fichier CSV en Objets JS
**/
function parseTextIntoData (data) {
    var tempData = data;
    let allRows = chunkArray(data.split(';'), 95); // split text to global array delimited by end of line // Ex: ["id,name,age"],["1,louis,25"],...
    allRows = allRows.filter(function (el) { // filter useless lines where ther is no data but only "" empty string
        return el !== "";
    });
    //console.log(allRows);

    let cols = allRows.shift(); // remove first line array which must be colons names

    //console.log(cols);

    
    for (var k in allRows) { // build new array with key as colon defining value
        let newItem = {};
        for (let i in allRows[k]) {
            var newKey = cols[i].replace('\n', '').replace('\\', '').replace(/["]+/g,'');
            var newValue = allRows[k][i].replace('\n', '').replace('\\', '').replace(/["]+/g,'');
            newItem[newKey] = newValue;
        }
        //console.log("++++",newItem);
        collection.push(newItem);
    }
    console.log(collection);
    disableLoader();
}



var selectedProducts = [];
var filters = {};
/**
*Permet de créer un filtre de recherche sur les produits
**/
function searchProducts(){

  for(const[key, value] of choices.entries()){
    filters[key] = value;
  };
  console.log("Filters : ", filters);

  if(selectedProducts.length > 0){
    /*console.log("11111111111111111111111");*/
    productsFiltration(selectedProducts);
  } else {
    /*console.log("2222222222222222222222");*/
    productsFiltration(collection);
  }

  console.log("selectedProducts ", selectedProducts);
  document.getElementById('products-number').innerHTML = selectedProducts.length;
  if(selectedProducts.length <= 500){ //display button only if there is less than 500 products founded
    document.getElementById('detail-btn').style.display = "block";
  }

}

/**
*Retourne une la liste des produits respectant les filtres (options sélectionnées)
**/
function productsFiltration(productsArray){
  selectedProducts = productsArray.filter(function(product){
      /*console.log("Product : ",product);*/
      for(var attribute in filters){
        /*console.log("Attribute : "+attribute+" -> "+filters[attribute]);*/
        /*console.log("Product attribute : "+product[attribute]);*/
        //console.log("~~~~~~~~~~"+attribute.split(' ').join('_')+"    "+filters[attribute]);
        if(product[attribute.split('_').join(' ')] != filters[attribute]){
          return false;
        }
      }
      return true;
  });
}

/**
*Permet de désactiver les options qui ne sont pas existantes parmis les produits filtrés
**/
function availableOptions(){
  for(const[key, values] of selectsMap.entries()){
    /*console.log("selectsMapEntry -> key : ", key, " - values : ", values);*/
    var allValues = [];
    var validValues = [];
    selectedProducts.forEach(function (product){
      values.forEach(function (val){
        /*console.log(val.id);*/
        if(!allValues.includes(val.id)){
          allValues.push(val.id);
        }
        for(const [productKey, productValue] of Object.entries(product)){
          //console.log("productKey : ", productKey, " - productValue : ", productValue, " - key : ", key, " - val : ", val);
          if(productKey == key.split('_').join(' ') && val.id == productValue){
            if(!validValues.includes(val.id)){
              validValues.push(val.id);
            }
          }
        }
      });      
    });
    
    allValues.forEach(function(value){
      /*console.log("ALL VALUES ", allValues),*/
      /*console.log("THE VALUE = ", value, " - validValues ",validValues);*/
      if(!validValues.includes(value)){
        var toDisable = document.querySelectorAll("option[data-designation='"+value+"']");
        toDisable.forEach(function(option){
          option.style.display = "none";
        });
      } else{
        /*console.log("ssssssssssssssssssssssssss ", value);*/
      }
    });

    if(validValues.length == 0){
      disableEmptySelects(key);
    }    
  }
}



jQuery('#detail-btn').click(function(){
  var uri = document.getElementById('uri-detail-page').value;
  sessionStorage.setItem('SelectedProducts', JSON.stringify(selectedProducts));
  window.location.href = uri;
});



function disableEmptySelects(key){
  var emptyDivs = document.querySelectorAll("div[data-div-category='"+key+"']");
  emptyDivs.forEach(function(emptyDiv){
    emptyDiv.style.display = "none";
  });
}


function activeLoader(){
  console.log('Loader active');
  //jQuery('#loader').addClass("loader");
  loader.classList.add("loader");
  //jQuery('div#wrapper').click(false);
  document.getElementById('configurator-area').classList.add('opacity');
  document.getElementById('products-informations').classList.add('opacity');
}
function disableLoader(){
  loader.classList.remove("loader");
  document.getElementById('configurator-area').classList.remove('opacity');
  document.getElementById('products-informations').classList.remove('opacity');
}
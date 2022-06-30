// https://stackoverflow.com/questions/46284405/how-can-i-use-eslint-no-unused-vars-for-a-block-of-code
/* eslint-disable no-unused-vars, no-undef */


// Если нужны всплывающие окна при нажатии: https://developers.google.com/maps/documentation/javascript/infowindows

const mapID = 'map';
const mapCenter =
  document.querySelector('[data-map-center]') &&
  document.querySelector('[data-map-center]').dataset.mapCenter.split(',')
  || [50.450976, 30.522575];

const mapObjects = document.querySelectorAll('[data-map-obj]');
let mapsArr = [];
mapObjects.forEach(el => {
  mapsArr.push(typeof el.dataset.mapObj === 'string' ? JSON.parse(el.dataset.mapObj) : el.dataset.mapObj);
});

function initMap() {
  const mapEl = document.getElementById(mapID);

  if (mapEl) {
    const map = new google.maps.Map(mapEl, {
      center: {lat: +mapCenter[0], lng: +mapCenter[0]},
      zoom: 10
    });

    mapsArr.forEach(item => {
      const marker = new google.maps.Marker({
        position: {lat: item.coords[0], lng: item.coords[1]},
        map: map,
        //title: 'Hello World!' // Всплывающяя подсказка
      });
    });
  }
}


// Яндекс карта

// document.addEventListener('DOMContentLoaded', () => {

//   const mapID = 'map';

//   const mapCenter =
//     document.querySelector('[data-map-center]') &&
//     document.querySelector('[data-map-center]').dataset.mapCenter.split(',')
//     || [50.450441, 30.523550];

//   const mapObjects = document.querySelectorAll('[data-map-obj]');
//   let mapsArr = [];
//   mapObjects.forEach(el => {
//     mapsArr.push(typeof el.dataset.mapObj === 'string' ? JSON.parse(el.dataset.mapObj) : el.dataset.mapObj);
//   });

//   if (document.getElementById(mapID)) ymaps.ready(init);

//   function init() {
//     const myMap = new ymaps.Map(mapID, {
//       center: mapCenter,
//       zoom: 10
//     });

//     // https://tech.yandex.ru/maps/jsapi/doc/2.1/dg/concepts/controls/standard-docpage/
//     // myMap.controls.remove('zoomControl');
//     myMap.controls.remove('geolocationControl');
//     myMap.controls.remove('searchControl');
//     myMap.controls.remove('routeButtonControl');
//     myMap.controls.remove('routeButtonControl');
//     myMap.controls.remove('trafficControl');
//     myMap.controls.remove('typeSelector');
//     myMap.behaviors.disable('scrollZoom');

//     mapsArr.forEach(item => {

//       myMap.geoObjects.add(new ymaps.Placemark(item.coords, {
//         balloonContent: item.text
//       }, {
//         preset: 'islands#icon',
//         iconColor: '#00baae'
//       }));

//     });

//   }

// });
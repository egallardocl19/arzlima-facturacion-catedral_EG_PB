/*
Template Name: Dason - Admin & Dashboard Template
Author: Themesbrand
Website: https://themesbrand.com/
Contact: themesbrand@gmail.com
File: Color Switcher Js File
*/

// GLightbox Popup


function themeColor() {
    var activeCustomcolor = window.localStorage.getItem("activeCustomcolor");
    switch (activeCustomcolor) {
      case "customizer-color01":
        document.documentElement.style.setProperty(
          "--bs-primary-rgb",
          "97, 83, 204"
        );
        break;
  
      case "customizer-color02":
        document.documentElement.style.setProperty(
          "--bs-primary-rgb",
          "4, 135, 101"
        );
        break;
  
      case "customizer-color03":
        document.documentElement.style.setProperty(
          "--bs-primary-rgb",
          "48, 197, 210"
        );
        break;
  
      default:
        document.documentElement.style.setProperty("--bs-primary-rgb", "");
    }
  }
  themeColor();
  

document.documentElement.style.setProperty(
    "--bs-primary-rgb",
    window.localStorage.getItem("colorPrimary")
  );
  document.documentElement.style.setProperty(
    "--bs-secondary-rgb",
    window.localStorage.getItem("colorSecondary")
  );
  
  function themeColor(primaryColor) {
    var activeCustomcolor = localStorage.getItem("activeCustomcolor");
    if (activeCustomcolor) {
      document.getElementById(activeCustomcolor).checked = true;
    }
    document.querySelectorAll(".theme-color").forEach(function (item) {
      var colorRadioElements = document.querySelector(
        "input[name=bgcolor-radio]:checked"
      );
  
      if (colorRadioElements) {
        colorRadioElements = colorRadioElements.id;
  
        var elementsColor = document.getElementsByClassName(colorRadioElements);
  
        var color = window
          .getComputedStyle(elementsColor[0], null)
          .getPropertyValue("background-image");
  
        rgbColorSecondary = color.substring(
          color.indexOf("b") + 2,
          color.indexOf(")")
        );
        rgbColorPrimary = color.substring(
          color.lastIndexOf("(") + 1,
          color.lastIndexOf(")") - 1
        );
      }
  
      item.addEventListener("click", function (event) {
        if (item.id) {
          localStorage.setItem("activeCustomcolor", item.id);
        }
        // choose theme color
        var colorRadioElements = document.querySelector(
          "input[name=bgcolor-radio]:checked"
        );
  
        if (colorRadioElements) {
          colorRadioElements = colorRadioElements.id;
  
          var elementsColor = document.getElementsByClassName(colorRadioElements);
          if (elementsColor) {
            var color = window
              .getComputedStyle(elementsColor[0], null)
              .getPropertyValue("background-image");
  
            rgbColorSecondary = color.substring(
              color.indexOf("b") + 2,
              color.indexOf(")")
            );
            rgbColorPrimary = color.substring(
              color.lastIndexOf("(") + 1,
              color.lastIndexOf(")") - 1
            );
  
            window.localStorage.setItem("colorPrimary", rgbColorPrimary);
            window.localStorage.setItem("colorSecondary", rgbColorSecondary);
  
            document.documentElement.style.setProperty(
              "--bs-primary-rgb",
              window.localStorage.getItem("colorPrimary")
            );
            document.documentElement.style.setProperty(
              "--bs-secondary-rgb",
              window.localStorage.getItem("colorSecondary")
            );
          }
        }
      });
    });
}

  var primaryColor = window
  .getComputedStyle(document.body, null)
  .getPropertyValue("--bs-primary-rgb");
themeColor(primaryColor);
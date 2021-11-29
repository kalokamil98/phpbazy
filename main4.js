const update = (x) => {
  const td = document.getElementById(x).children;
  const form = document.querySelector("#form_1");
  let input = form.getElementsByTagName("input");

  for (let x = 0; x < td.length - 3; x++) {
    input[x + 1].defaultValue = td[x + 1].textContent;
  }

  let id = document.createElement("input");

  id.name = "id";
  id.value = x;
  id.type = "hidden";
  document.getElementById("row_id").innerHTML = `id : ${x}`;
  document.getElementById("row_id").appendChild(id);
  document.querySelector("#form_1").style.display = "flex";
};

const close_form = (x) => {
  document.querySelector(`#form_${x}`).style.display = "none";
};

const add = () => {
  document.querySelector(`#form_2`).style.display = "flex";
};

const user = document.getElementById("user");

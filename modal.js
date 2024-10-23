document.addEventListener("DOMContentLoaded", function () {
  // Modal CRUD Sabores
  const btnSabores = document.querySelector(".btn-sabores");
  const dialogSabores = document.querySelector(".crudSabores");

  if (btnSabores && dialogSabores) {
    btnSabores.onclick = function () {
      dialogSabores.showModal();
      dialogSabores.classList.remove("esconde");
    };
  }

  // Modal CRUD Produto
  const btnProduto = document.querySelector(".btn-produto");
  const dialogProduto = document.querySelector(".crudProduto");

  if (btnProduto && dialogProduto) {
    btnProduto.onclick = function () {
      dialogProduto.showModal();
      dialogProduto.classList.remove("esconde");
    };
  }

  // Fechar Modal CRUD Sabores
  const fechaModalSabor = dialogSabores.querySelector(".fechar-modal");
  if (fechaModalSabor) {
    fechaModalSabor.addEventListener("click", () => {
      dialogSabores.close();
      dialogSabores.classList.add("esconde"); // Adicione essa linha
    });
  }

  // Fechar Modal CRUD Produto
  const fechaModalProduto = dialogProduto.querySelector(".fechar-modal");
  if (fechaModalProduto) {
    fechaModalProduto.addEventListener("click", () => {
      dialogProduto.close();
      dialogProduto.classList.add("esconde"); // Adicione essa linha
    });
  }

  const addProduto = document.querySelector(".form-produto");
  const messageProduto = document.querySelector("#messageProduto");

  if (addProduto && messageProduto) {
    addProduto.onsubmit = function (event) {
      messageProduto.classList.remove("hidden");

      setTimeout(() => {
        messageProduto.classList.add("hidden");
      }, 3000);
    };
  }
});

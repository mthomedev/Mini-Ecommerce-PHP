const nav = document.querySelector("nav");

/* ───────── NAV SCROLL ───────── */

window.addEventListener("scroll", () => {
  if (window.scrollY > 40) {
    nav.classList.add("nav-scrolled");
  } else {
    nav.classList.remove("nav-scrolled");
  }
});

/* ───────── ELEMENTOS ───────── */

const cartBtn = document.getElementById("cart-btn");

const cartSidebar = document.getElementById("cart-sidebar");

const cartOverlay = document.getElementById("cart-overlay");

const closeCart = document.getElementById("close-cart");

const cartContent = document.getElementById("cart-content");

const toast = document.getElementById("toast");

/* ───────── ABRIR CARRINHO ───────── */

async function carregarCarrinho() {
  try {
    const response = await fetch("sidebar_carrinho.php");

    const html = await response.text();

    cartContent.innerHTML = html;
  } catch (erro) {
    console.error(erro);

    cartContent.innerHTML = `
      <p class="empty-cart">
        Erro ao carregar carrinho.
      </p>
    `;
  }
}

function abrirCarrinho() {
  cartSidebar.classList.add("active");

  cartOverlay.classList.add("active");

  carregarCarrinho();
}

function fecharCarrinho() {
  cartSidebar.classList.remove("active");

  cartOverlay.classList.remove("active");
}

/* ───────── EVENTOS SIDEBAR ───────── */

cartBtn.addEventListener("click", (e) => {
  e.preventDefault();

  abrirCarrinho();
});

closeCart.addEventListener("click", fecharCarrinho);

cartOverlay.addEventListener("click", fecharCarrinho);

cartContent.addEventListener("click", (e) => {
  if (e.target.classList.contains("remove-from-cart-btn")) {
    e.preventDefault();

    const productId = e.target.dataset.id;

    removerDoCarrinho(productId);
  }
});

/* ───────── ADICIONAR AO CARRINHO ───────── */

const cartForms = document.querySelectorAll(".cart-form");

cartForms.forEach((form) => {
  form.addEventListener("submit", async (e) => {
    e.preventDefault();

    const formData = new FormData(form);

    try {
      const response = await fetch("adicionar_carrinho.php", {
        method: "POST",

        body: formData,
      });

      const data = await response.json();

      if (data.success) {
        showToast(data.message);

        atualizarBadgeCarrinho(data.cartCount);

        carregarCarrinho();
      } else {
        showToast(data.message, true);
      }
    } catch (erro) {
      console.error(erro);

      showToast("Erro ao adicionar produto.", true);
    }
  });
});

/* ───────── REMOVER DO CARRINHO ───────── */

async function removerDoCarrinho(id) {
  try {
    const response = await fetch("remover_carrinho.php?id=" + id);

    const data = await response.json();

    if (data.success) {
      showToast(data.message);

      atualizarBadgeCarrinho(data.cartCount);

      carregarCarrinho();
    } else {
      showToast(data.message, true);
    }
  } catch (erro) {
    console.error(erro);

    showToast("Erro ao remover produto.", true);
  }
}

/* ───────── BADGE ───────── */

function atualizarBadgeCarrinho(total) {
  let badge = document.querySelector(".cart-badge");

  if (total <= 0) {
    if (badge) {
      badge.remove();
    }

    return;
  }

  if (!badge) {
    badge = document.createElement("span");

    badge.classList.add("cart-badge");

    cartBtn.appendChild(badge);
  }

  badge.textContent = total;
}

/* ───────── TOAST ───────── */

function showToast(message, error = false) {
  toast.textContent = message;

  toast.classList.remove("show");

  if (error) {
    toast.style.background = "linear-gradient(135deg, #c41e1e, #ff5a5a)";
  } else {
    toast.style.background = "linear-gradient(135deg, #1f9d55, #34d399)";
  }

  setTimeout(() => {
    toast.classList.add("show");
  }, 10);

  setTimeout(() => {
    toast.classList.remove("show");
  }, 3000);
}

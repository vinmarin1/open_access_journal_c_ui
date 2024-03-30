
// fetch data based on current page
const currentPageItem = document.querySelector(`.page-item:nth-child(2)`);
currentPageItem.classList.add("active");
function changePage(page) {
  event.preventDefault();

  const pageItems = document.querySelectorAll(".page-item");
  pageItems.forEach((item) => item.classList.remove("active"));

  const currentPageItem = document.querySelector(
    `.page-item:nth-child(${page + 1})`
  );
  if (currentPageItem) {
    currentPageItem.classList.add("active");
  }
 
  sortBySelected = sortBySelect.value;

}

// generate pagination items button
function generatePagination(totalItems) {
  const totalPages = Math.ceil(totalItems / 10);
  const paginationContainer = document.getElementById("pagination-container");

  // Clear existing content
  paginationContainer.innerHTML = "";

  for (let i = 0; i < totalPages; i++) {
    const pageItem = document.createElement("li");
    pageItem.classList.add("page-item");

    const pageLink = document.createElement("a");
    pageLink.classList.add("page-link");
    pageLink.href = "javascript:void(0);";
    pageLink.textContent = i + 1;

    pageLink.addEventListener("click", function () {
      changePage(i);
    });

    pageItem.appendChild(pageLink);
    paginationContainer.appendChild(pageItem);

  }

}

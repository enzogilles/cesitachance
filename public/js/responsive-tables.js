document.addEventListener('DOMContentLoaded', function() {
  // Add table-responsive class to all table containers
  const tables = document.querySelectorAll('.styled-table');
  tables.forEach(table => {
    if (!table.parentNode.classList.contains('table-responsive')) {
      const wrapper = document.createElement('div');
      wrapper.className = 'table-responsive';
      table.parentNode.insertBefore(wrapper, table);
      wrapper.appendChild(table);
    }
  });
  
  // Dynamically add data-labels to cells if not already present
  tables.forEach(table => {
    const headerTexts = [];
    const headerCells = table.querySelectorAll('thead th');
    
    // Get header texts
    headerCells.forEach(th => {
      headerTexts.push(th.textContent.trim());
    });
    
    // Add data-label to cells without them
    const bodyRows = table.querySelectorAll('tbody tr');
    bodyRows.forEach(row => {
      const cells = row.querySelectorAll('td');
      cells.forEach((cell, index) => {
        if (!cell.hasAttribute('data-label') && index < headerTexts.length) {
          cell.setAttribute('data-label', headerTexts[index]);
        }
      });
    });
  });
});
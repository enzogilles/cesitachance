document.getElementById('cv').addEventListener('change', function() {
  const removeButton = document.getElementById('remove-cv');
  const fileNameLabel = document.getElementById('cv-label');
  if (this.files.length > 0) {
  fileNameLabel.textContent = this.files[0].name;
  removeButton.style.display = 'inline-block';
  } else {
  fileNameLabel.textContent = '';
  removeButton.style.display = 'none';
  }
});

document.getElementById('remove-cv').addEventListener('click', function() {
  const cvInput = document.getElementById('cv');
  const fileNameLabel = document.getElementById('cv-label');
  cvInput.value = '';
  fileNameLabel.textContent = '';
  this.style.display = 'none';
});

document.querySelector('.reset-btn').addEventListener('click', function() {
  const cvInput = document.getElementById('cv');
  const fileNameLabel = document.getElementById('cv-label');
  const removeButton = document.getElementById('remove-cv');
  cvInput.value = '';
  fileNameLabel.textContent = '';
  removeButton.style.display = 'none';
});
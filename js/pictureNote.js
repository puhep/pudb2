function editnote(id, partType, oldNote) {
  let newVal = prompt("Add the new note", oldNote)

  /* Error checking to see that there is a new value entered */
  if (newVal === "" || newVal === null || newVal === oldNote || typeof newVal === 'undefined') {
    return;
  }
  url = './php/editPictureNote.php?id=' + id + '&partType=' + partType + '&noteText=' + newVal
  console.log(url)
  $.ajax({
    url: url,
    success: success
  });
}

function deletenote(id, partType, partID, fileName) {
  if (id < 0 || typeof id === 'undefined' || id === NaN) {
    return;
  }
  if (confirm("Are you sure you want to delete that picture?")) {
    let url = './php/deletePicture.php?id=' + id + '&partType=' + partType + '&partID=' + partID + '&fileName=' + fileName
    console.log(url)
    $.ajax({
      url: url,
      success: success
   });
  }
}

function success() {
  location.reload(true);
}

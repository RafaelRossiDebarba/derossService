
function deleteProduct(id, name) {
  Swal.fire({
      title: 'Tem certeza?',
      text: `Você está prestes a excluir o produto ${name}.`,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Sim, excluir',
      cancelButtonText: 'Cancelar'
  }).then((result) => {
      if (result.isConfirmed) {
          axios.delete(`/products/${id}`)
              .then(() => {
                  Swal.fire(
                      'Excluído!',
                      'O produto foi excluído com sucesso.',
                      'success'
                  ).then(() => {
                      location.reload();
                  });
              })
              .catch(() => {
                  Swal.fire(
                      'Erro!',
                      'Não foi possível excluir o produto.',
                      'error'
                  );
              });
      }
  });
}
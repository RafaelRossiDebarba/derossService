
function deleteService(id) {
  Swal.fire({
      title: 'Tem certeza?',
      text: `Você está prestes a excluir o serviço.`,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Sim, excluir',
      cancelButtonText: 'Cancelar'
  }).then((result) => {
      if (result.isConfirmed) {
          axios.delete(`/services/${id}`)
              .then(() => {
                  Swal.fire(
                      'Excluído!',
                      'O serviço foi excluído com sucesso.',
                      'success'
                  ).then(() => {
                      location.reload();
                  });
              })
              .catch(() => {
                  Swal.fire(
                      'Erro!',
                      'Não foi possível excluir o serviço.',
                      'error'
                  );
              });
      }
  });
}

function deleteProductOrder(id) {
    Swal.fire({
        title: 'Tem certeza?',
        text: `Você está prestes a excluir o produto do serviço.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sim, excluir',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            axios.delete(`/orders/product/${id}`)
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

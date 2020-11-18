let check_role = (role) => {
  console.log(role.value)
  if (role.value == 5) {
    const hide_data = (id) => {
      document.getElementById(id).style.display = 'inline';
    }

    hide_data('f_code_label');
    hide_data('f_code_input');
    hide_data('e_contact_input');
    hide_data('e_contact_label');
    hide_data('relation_input');
    hide_data('relation_label');
  }
  else{
    const show_data = (id) => {
      document.getElementById(id).style.display = 'none';
    }

    show_data('f_code_label');
    show_data('f_code_input');
    show_data('e_contact_input');
    show_data('e_contact_label');
    show_data('relation_input');
    show_data('relation_label');
  }
}

let check_role = (role) => {
  if (role.value == 5) {
    let show_data = (id) => {
      document.getElementById(id).style.display = 'inline';
    }

    show_data('f_code_label');
    show_data('f_code_input');
    show_data('e_contact_input');
    show_data('e_contact_label');
    show_data('relation_input');
    show_data('relation_label');
  }
  else{
    let hide_data = (id) => {
      document.getElementById(id).style.display = 'none';
    }
    hide_data('f_code_label');
    hide_data('f_code_input');
    hide_data('e_contact_input');
    hide_data('e_contact_label');
    hide_data('relation_input');
    hide_data('relation_label');

  }
}

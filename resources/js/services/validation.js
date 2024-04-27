import {ref} from "vue";

export default function useValidation() {

   const errors=ref({});

   const validateCreateForm=(data)=>{
        if (!data.title) {
            errors.value.title = 'Title is required';
            return false ;
        }
        if (!data.status) {
            errors.value.status = 'Status is required';
            return false ;
        }
        if (!data.due_date) {
            errors.value.due_date = 'Due Date is required';
            return false ;
        } 
        else if (new Date(data.due_date) <= new Date()) {
            errors.value.due_date = 'Due Date must be a future date';
            return false ;
        }

        return true ;
    }

    const validateLoginForm=(data)=>{
        if (!data.email) {
            errors.value.email = 'Email is required';
            return false ;
        }
    
        if (!data.password) {
            errors.value.password= 'Password is required';
            return false ;
        }
    
        else if (data.password.length<6) {
            errors.value.due_date = 'The password must be at least six characters';
            return false ;
        }
    
        return true ;
    }

    const validateRegisterForm=(data)=>{
        if (!data.firstname) {
            errors.value.firstname = 'The firstname is required';
            return false ;
        }
    
        if (!data.lastname) {
            errors.value.lastname = 'The lastname is required';
            return false ;
        }
    
        if (!data.email) {
            errors.value.email = 'The email is required';
            return false ;
        }
    
        if (!data.password) {
            errors.value.password= 'The password is required';
            return false ;
        }
    
        else if (data.password.length<6) {
            errors.value.due_date = 'The password must be at least six characters';
            return false ;
        }
    
        else if (data.password!=data.password_confirmation) {
            errors.value.password_confirmation = 'The password confirmation does not match';
            return false ;
        }
    
        return true ;
    }

    const validateEditForm=(data)=>{
        if (!data.title) {
            errors.value.title = 'Title is required';
            return false ;
        }
        if (!data.status) {
            errors.value.status = 'Status is required';
            return false ;
        }
        if (!data.due_date) {
            errors.value.due_date = 'Due Date is required';
            return false ;
        } 
        else if (new Date(data.due_date) <= new Date()) {
            errors.value.due_date = 'Due Date must be a future date';
            return false ;
        }
    
        return true ;
    }

    
    return {
        errors,
        validateCreateForm,
        validateLoginForm,
        validateRegisterForm,
        validateEditForm
    }
    

}

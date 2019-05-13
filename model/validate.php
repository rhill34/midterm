<?php

/* Validate the form
 * @return boolean
 */
function validForm()
{
    global $f3;
    $isValid = true;

    if (!validFood($f3->get('food'))) {

        $isValid = false;
        $f3->set("errors['food']", "Please enter a food item");
    }

    if (!validQty($f3->get('qty'))) {

        $isValid = false;
        $f3->set("errors['qty']", "Please enter 1 or more");
    }

    if (!validMeal($f3->get('meal'))) {

        $isValid = false;
        $f3->set("errors['meal']", "Please select a meal");
    }

    if (!validCondiments($f3->get('cond'))) {

        $isValid = false;
        $f3->set("errors['cond']", "Invalid selection");
    }

    return $isValid;
}

/* Validate a food
 * Food must not be empty and may only consist
 * of alphabetic characters.
 *
 * @param String food
 * @return boolean
 */
function validFood($food)
{
    return !empty($food) && ctype_alpha($food);

}

/* Validate quantity
 * Quantity must not be empty and must be a number
 * greater than 1.
 *
 * @param String qty
 * @return boolean
 */
function validQty($qty)
{
    return (!empty($qty)
        && ctype_digit($qty)
        && (1 <= $qty));
}

/* Validate a meal
 *
 * @param String meal
 * @return boolean
 */
function validMeal($meal)
{
    global $f3;
    in_array($meal, $f3->get('meals'));
    return true;
}

/* Validate condiments
 *
 * @param String cond
 * @return boolean
 */
function validCondiments($cond)
{
    global $f3;
    return true;
}
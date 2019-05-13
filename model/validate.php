<?php

/* Validate the form
 * @return boolean
 */
function validForm()
{
    global $f3;
    $isValid = true;
    if (!validFood($f3->get('name'))) {

        $isValid = false;
        $f3->set("errors['name']", "Please enter a alphabetical name! (No spaces)");
    }

    if (!validCondiments($f3->get('meal'))) {
        $isValid = false;
        $f3->set("errors['meal']", "Invalid selection");
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
    return (!empty($cond) && 0 == count(array_diff($cond, $f3->get('meal'))));
}
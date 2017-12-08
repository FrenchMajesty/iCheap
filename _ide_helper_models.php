<?php
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\Book
 *
 * @property int $id
 * @property string $isbn
 * @property float $price
 * @property string $title
 * @property string $authors
 * @property string $publisher
 * @property string $description
 * @property string $image
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property \App\Book\BookDimensions $dimensions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Sell\Order[] $orders
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Book onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Book whereAuthors($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Book whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Book whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Book whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Book whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Book whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Book whereIsbn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Book wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Book wherePublisher($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Book whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Book whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Book withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Book withoutTrashed()
 */
	class Book extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property int $id
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property bool $email_verified
 * @property string $password
 * @property string $account
 * @property int $rank
 * @property string|null $photo
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property \App\Model\Accounts\Address $address
 * @property-read \App\Model\Accounts\Registration\EmailVerificationToken $emailVerificationToken
 * @property-read string $name
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Sell\Order[] $orders
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Sell\Order[] $ordersDone
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\User onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmailVerified($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereFirstname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereLastname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRank($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\User withoutTrashed()
 */
	class User extends \Eloquent {}
}

namespace App\Model\Sell{
/**
 * App\Model\Sell\Order
 *
 * @property int $id
 * @property int $user_id
 * @property int $book_id
 * @property string $book_tracking
 * @property string|null $payment_tracking
 * @property float|null $payment_amount
 * @property int $status_id
 * @property \Carbon\Carbon|null $received_at
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property-read \App\Book $book
 * @property-read \App\Model\Shipping\Payment $paymentShipping
 * @property-read \App\Model\Shipping\Label $shippingLabel
 * @property-read \App\Model\Sell\OrderStatus $status
 * @property-read \App\User $user
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Sell\Order onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Sell\Order whereBookId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Sell\Order whereBookTracking($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Sell\Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Sell\Order whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Sell\Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Sell\Order wherePaymentAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Sell\Order wherePaymentTracking($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Sell\Order whereReceivedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Sell\Order whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Sell\Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Sell\Order whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Sell\Order withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Sell\Order withoutTrashed()
 */
	class Order extends \Eloquent {}
}

namespace App\Model\Sell{
/**
 * App\Model\Sell\OrderStatus
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Sell\Order[] $currentOrders
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Sell\OrderStatus whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Sell\OrderStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Sell\OrderStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Sell\OrderStatus whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Sell\OrderStatus whereUpdatedAt($value)
 */
	class OrderStatus extends \Eloquent {}
}

namespace App\Model\Shipping{
/**
 * App\Model\Shipping\Label
 *
 * @property int $id
 * @property int $order_id
 * @property string $shippo_object_id
 * @property string $label_url
 * @property string $tracking_url
 * @property string $tracking_number
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property-read \App\Model\Sell\Order $order
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Shipping\Label onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Shipping\Label whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Shipping\Label whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Shipping\Label whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Shipping\Label whereLabelUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Shipping\Label whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Shipping\Label whereShippoObjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Shipping\Label whereTrackingNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Shipping\Label whereTrackingUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Shipping\Label whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Shipping\Label withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Shipping\Label withoutTrashed()
 */
	class Label extends \Eloquent {}
}

namespace App\Model\Shipping{
/**
 * App\Model\Shipping\Payment
 *
 * @property int $id
 * @property int $order_id
 * @property string $shippo_object_id
 * @property string $label_url
 * @property string $tracking_url
 * @property string $tracking_number
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property-read \App\Model\Sell\Order $order
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Shipping\Payment onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Shipping\Payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Shipping\Payment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Shipping\Payment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Shipping\Payment whereLabelUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Shipping\Payment whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Shipping\Payment whereShippoObjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Shipping\Payment whereTrackingNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Shipping\Payment whereTrackingUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Shipping\Payment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Shipping\Payment withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Shipping\Payment withoutTrashed()
 */
	class Payment extends \Eloquent {}
}

namespace App\Model\Accounts\Registration{
/**
 * App\Model\Accounts\Registration\EmailVerificationToken
 *
 * @property int $id
 * @property int $user_id
 * @property string $token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property-read \App\User $user
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounts\Registration\EmailVerificationToken onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Accounts\Registration\EmailVerificationToken whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Accounts\Registration\EmailVerificationToken whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Accounts\Registration\EmailVerificationToken whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Accounts\Registration\EmailVerificationToken whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Accounts\Registration\EmailVerificationToken whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Accounts\Registration\EmailVerificationToken whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounts\Registration\EmailVerificationToken withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounts\Registration\EmailVerificationToken withoutTrashed()
 */
	class EmailVerificationToken extends \Eloquent {}
}

namespace App\Model\Accounts{
/**
 * App\Model\Accounts\Address
 *
 * @property int $id
 * @property int $user_id
 * @property string $address
 * @property string|null $address_2
 * @property string $city
 * @property string $state
 * @property string $zip
 * @property string $country
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read string $formatted
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Accounts\Address whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Accounts\Address whereAddress2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Accounts\Address whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Accounts\Address whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Accounts\Address whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Accounts\Address whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Accounts\Address whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Accounts\Address whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Accounts\Address whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Accounts\Address whereZip($value)
 */
	class Address extends \Eloquent {}
}

namespace App\Model\Accounts{
/**
 * App\Model\Accounts\Student
 *
 */
	class Student extends \Eloquent {}
}

namespace App\Book{
/**
 * App\Book\BookDimensions
 *
 * @property int $id
 * @property int $book_id
 * @property float $height
 * @property float $width
 * @property float $thickness
 * @property float|null $weight
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property-read \App\Book $book
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Book\BookDimensions onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Book\BookDimensions whereBookId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Book\BookDimensions whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Book\BookDimensions whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Book\BookDimensions whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Book\BookDimensions whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Book\BookDimensions whereThickness($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Book\BookDimensions whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Book\BookDimensions whereWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Book\BookDimensions whereWidth($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Book\BookDimensions withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Book\BookDimensions withoutTrashed()
 */
	class BookDimensions extends \Eloquent {}
}


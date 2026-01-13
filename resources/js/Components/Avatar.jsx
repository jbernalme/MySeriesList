// import fallback from "../../../storage/app/public/img/notProfileImage.jpg";

const Avatar = ({
    className,
    src,
    alt,
    fallBackSrc = "/img/notProfileImage.jpg",
}) => {
    return (
        <img
            className={
                "rounded-full border-2 border-kiwi w-28 h-28 " + className
            }
            src={src}
            alt={alt}
            onError={(e) => (e.currentTarget.src = fallBackSrc)}
        />
    );
};

export default Avatar;

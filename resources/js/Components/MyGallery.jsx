import React, { useState } from "react";
import FsLightbox from "fslightbox-react";

const MyGallery = ({ data, type = "image" }) => {
    // data example
    // [
    //     {
    //         thumbnail: 'https://image.tmdb.org/t/p/w300//6Lw54zxm6BAEKJeGlabyzzR5Juu.jpg',
    //         source: 'https://image.tmdb.org/t/p/original//6Lw54zxm6BAEKJeGlabyzzR5Juu.jpg'
    //     }
    // ]
    const [toggler, setToggler] = useState(false);
    const [currentIndex, setCurrentIndex] = useState(0);

    const handleToggle = (index) => {
        setCurrentIndex(index);
        setToggler(!toggler);
    };

    const getSource = (type, data) => {
        return data.map((item) =>
            type === "image"
                ? item.source
                : `https://www.youtube.com/watch?v=${item.source}`
        );
    };

    return (
        <>
            {data.length > 0 ? (
                <>
                    <div className="flex flex-wrap gap-4 ">
                        {data.map((item, index) => (
                            <figure
                                key={index}
                                className="overflow-hidden border-2 rounded-md border-kiwi"
                            >
                                <img
                                    className="transition duration-500 ease-in-out hover:opacity-50 w-80 h-44"
                                    src={item.thumbnail}
                                    onClick={() => handleToggle(index)}
                                />
                            </figure>
                        ))}
                    </div>
                    <FsLightbox
                        sourceIndex={currentIndex}
                        toggler={toggler}
                        // sources={getSource(type, data)}
                        sources={[
                            "https://i.imgur.com/fsyrScY.jpg",
                            "https://www.youtube.com/watch?v=3nQNiWdeH2Q",
                            "https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4",
                        ]}
                    />
                </>
            ) : (
                <h2 className="mt-20 text-2xl text-center ">
                    No hay recursos para mostrar
                </h2>
            )}
        </>
    );
};

export default MyGallery;

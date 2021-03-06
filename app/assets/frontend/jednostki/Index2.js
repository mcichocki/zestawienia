import React from "react";
import { render } from "react-dom";
import { App } from "./app";
import Loader from "react-loader-spinner";
import { usePromiseTracker } from "react-promise-tracker";

const LoadingIndicator = props => {
  const { promiseInProgress } = usePromiseTracker();

  return (
    promiseInProgress && (
      <div
        style={{
          width: "100%",
          height: "100",
          display: "flex",
          justifyContent: "center",
          alignItems: "center"
        }}
        >
        <Loader type="ThreeDots" color="#172b4d;" height="100" width="100" />
      </div>
    )
  );
};

render(
  <div>
    <App />
    <LoadingIndicator />
  </div>,
  document.getElementById("jednostki_index")
);
